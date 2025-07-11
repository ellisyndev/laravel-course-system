<?php

namespace App\Services\Api;

use App\Models\Course;
use App\Models\CourseSelection;
use App\Repositories\CourseRepository;
use App\Repositories\CourseSelectionRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class CourseSelectionService
{
    public function __construct(
        protected CourseSelectionRepository $courseSelectionRepository,
        protected CourseRepository $courseRepository,
    ) {}

    /**
     * 加選課程
     * @param  int  $studentId
     * @param  int  $courseId
     * @return CourseSelection
     */
    public function enroll(int $studentId, int $courseId): CourseSelection
    {
        return DB::transaction(function () use ($studentId, $courseId) {
            // 確認課程存在
            $course = $this->courseRepository->find($courseId);

            if (! $course) {
                throw ValidationException::withMessages([
                    'course_id' => ['課程不存在']
                ]);
            }

            // 查詢或建立選課紀錄
            $selection = $this->courseSelectionRepository->firstOrNew([
                'student_id' => $studentId,
                'course_id' => $courseId,
            ]);

            if ($selection->status === 'enrolled') {
                throw ValidationException::withMessages([
                    'course_id' => ['已加選此課程，無需重複加選']
                ]);
            }

            // 衝堂判斷
            if ($this->hasScheduleConflict($studentId, $course)) {
                throw ValidationException::withMessages([
                    'course_id' => ['課程時間與已加選課程衝突']
                ]);
            }

            $selection->status = 'enrolled';
            $selection->enrolled_at = now();
            $selection->withdrawn_at = null;
            $selection->save();

            // 清除快取

            return $selection;
        });
    }

    /**
     * 退選課程
     * @param  int  $studentId
     * @param  int  $courseId
     * @return CourseSelection
     */
    public function withdraw(int $studentId, int $courseId): CourseSelection
    {
        return DB::transaction(function () use ($studentId, $courseId) {
            $selection = $this->courseSelectionRepository->findOneBy(['course_id' => $courseId, 'student_id' => $studentId]);

            if (! $selection) {
                throw ValidationException::withMessages([
                    'course_id' => ['尚未加選此課程或已退選']
                ]);
            }

            if ($selection->status !== 'enrolled') {
                throw ValidationException::withMessages([
                    'course_id' => ['不可退選未加選的課程']
                ]);
            }

            $selection->status = 'withdrawn';
            $selection->withdrawn_at = now();
            $selection->save();

            return $selection;

            // 清除快取
        });
    }

    /**
     * 判斷是否衝堂
     */
    public function hasScheduleConflict(int $studentId, $newCourse): bool
    {
        // 取得該學生所有已加選課程
        $selectedCourses = CourseSelection::with('course')
            ->where('student_id', $studentId)
            ->where('status', 'enrolled')
            ->get()
            ->pluck('course');

        foreach ($selectedCourses as $course) {
            if (
                $newCourse->start_time_code < $course->end_time_code &&
                $newCourse->end_time_code > $course->start_time_code
            ) {
                return true;
            }
        }

        return false;
    }
}
