<?php

namespace App\Http\Controllers\Api;

use App\Enums\AdvancedApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\StudentCourse\SelectCourseRequest;
use App\Http\Resources\StudentCourse\SelectCourseResource;
use App\Models\CourseSelection;
use App\Services\Api\CourseSelectionService;
use App\Services\Api\CourseService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StudentCourseController extends Controller
{
    use AdvancedApiResponseTrait;

    public function __construct(
        protected CourseService $courseService,
        protected CourseSelectionService $courseSelectionService
    ) {}

    /**
     * 可選課程列表
     */
    public function availableCourses(Request $request) {}

    /**
     * 已選課程列表
     */
    public function selectedCourses(Request $request) {}
    public function select(SelectCourseRequest $request): JsonResponse
    {
        $student = $request->user();
        $courseId = $request->input('course_id');

        try {
            $course = $this->courseService->getCourseById($courseId);
            $select = $this->courseSelectionService->enroll($student->id, $courseId);

            return $this->respondSuccess(
                new SelectCourseResource($select),
                '加選課程成功'
            );
        } catch (\Exception $e) {
            return $this->respondError(
                '加選課程失敗: '.$e->getMessage(),
                null,
                422
            );
        }
    }

    public function cancel(SelectCourseRequest $request): JsonResponse
    {
        $student = $request->user();
        $courseId = $request->input('course_id');

        try {
            $course = $this->courseService->getCourseById($courseId);
            $cancel = $this->courseSelectionService->withdraw($student->id, $courseId);

            return $this->respondSuccess(
                new SelectCourseResource($cancel),
                '退選課程成功'
            );
        } catch (\Exception $e) {
            return $this->respondError(
                '退選課程失敗: '.$e->getMessage(),
                null,
                422
            );
        }
    }
}
