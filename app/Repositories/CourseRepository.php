<?php

namespace App\Repositories;

use App\Enums\CourseSelectionStatus;
use App\Models\Course;
use Illuminate\Pagination\LengthAwarePaginator;

class CourseRepository extends BaseRepository
{
    public function __construct(Course $course)
    {
        parent::__construct($course);
    }

    public function getCourseWithPagination(array $filters): LengthAwarePaginator
    {
        $model = $this->model->newQuery()->with('teacher', 'startTime', 'endTime');

        if (isset($filters['teacher_id'])) {
            $teacherId = $filters['teacher_id'] ?? null;
            $model->where('teacher_id', $teacherId);
        }

        if (isset($filters['is_required'])) {
            $isRequired = $filters['is_required'] ?? null;
            $model->where('is_required', $isRequired);
        }

        if (isset($filters['college_id'])) {
            $collegeId = $filters['college_id'] ?? null;
            $model->where('college_id', $collegeId);
        }

        if (isset($filters['department_id'])) {
            $departmentId = $filters['department_id'] ?? null;
            $model->where('department_id', $departmentId);
        }

        if (isset($filters['classroom_id'])) {
            $classroomId = $filters['classroom_id'] ?? null;
            $model->where('classroom_id', $classroomId);
        }

        if (isset($filters['level_code'])) {
            $levelCode = $filters['level_code'] ?? null;
            $model->where('level_code', $levelCode);
        }

        if (isset($filters['semester_code'])) {
            $semesterCode = $filters['semester_code'] ?? null;
            $model->where('semester_code', $semesterCode);
        }

        if (isset($filters['categories'])) {
            $categories = $filters['categories'] ?? [];
            $model->whereIn('category_id', $categories);
        }

        if (isset($filters['teacher_name'])) {
            $teacherName = $filters['teacher_name'] ?? '';
            $model->whereHas('teacher', function ($query) use ($teacherName) {
                $query->where('name', 'like', '%'.$teacherName.'%');
            });
        }

        if (isset($filters['course_code'])) {
            $courseCode = $filters['course_code'] ?? '';
            $model->where('code', 'like', '%'.$courseCode.'%');
        }

        if (isset($filters['q'])) {
            $searchTerm = $filters['q'] ?? '';
            $model->where(function ($query) use ($searchTerm) {
                $query->where('name', 'like', '%'.$searchTerm.'%')
                    ->orWhere('code', 'like', '%'.$searchTerm.'%');
            });
        }

        $sorting = $filters['sorting'] ?? 'id';
        $direction = $filters['direction'] ?? 'asc';

        $model->orderBy($sorting, $direction);

        $perPage = $filters['limit'] ?? 15;
        $page = $filters['page'] ?? 1;

        return $model->paginate(
            $perPage,
            ['*'],
            'page',
            $page
        );
    }

    /**
     * 取得並鎖定指定課程（避免同時加選）
     */
    public function findWithLock(int $courseId): ?Course
    {
        return $this->model
            ->newQuery()
            ->where('id', $courseId)
            ->lockForUpdate()
            ->first();
    }

    public function getCoursesByTeacherId(int $teacherId): \Illuminate\Database\Eloquent\Collection
    {
        return $this->model
            ->newQuery()
            ->where('teacher_id', $teacherId)
            ->with('teacher', 'startTime', 'endTime')
            ->get();
    }

    public function getCourseWithEnrolledStudents(int $teacherId, int $courseId): ?Course
    {
        return $this->model
            ->newQuery()
            ->where('id', $courseId)
            ->where('teacher_id', $teacherId)
            ->with([
                'teacher',
                'selections' => function ($query) {
                    $query->where('status', CourseSelectionStatus::Enrolled)
                        ->with([
                            'student.studentProfile.department',
                            'student.studentProfile.college',
                        ]);
                },
            ])
            ->first();
    }

    public function updateCourse(int $userId, int $courseId, array $data, bool $isAdmin = false): ?Course
    {
        $query = $this->model->newQuery()->where('id', $courseId);

        if (! $isAdmin) {
            $query->where('teacher_id', $userId); // 只有不是 admin 時才限制
        }

        $course = $query->first();

        if (! $course) {
            return null;
        }

        $course->fill($data)->save();

        return $course;
    }

    public function getCourseById(int $courseId): ?Course
    {
        return $this->model->find($courseId);
    }

    public function deleteCourse(int $courseId): bool
    {
        $course = $this->model->find($courseId);

        if (! $course) {
            return false;
        }

        return $course->delete();
    }
}
