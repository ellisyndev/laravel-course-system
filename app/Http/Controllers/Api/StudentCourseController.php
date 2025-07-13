<?php

namespace App\Http\Controllers\Api;

use App\Enums\AdvancedApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StudentCourse\SelectCourseRequest;
use App\Http\Resources\Api\StudentCourse\SelectCourseResource;
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
     * 已選課程列表
     */
    public function index(Request $request): JsonResponse
    {
        $studentId = $request->user()->id;

        $selections = $this->courseSelectionService->getCourseSelectionsByStudentId($studentId);

        return $this->respondSuccess(
            SelectCourseResource::collection($selections->load('course'))->map->withDetail(),
            '已選課程列表取得成功'
        );
    }

    public function select(SelectCourseRequest $request): JsonResponse
    {
        $student = $request->user();
        $courseId = $request->input('course_id');

        try {
            $course = $this->courseService->getCourseById($student->id, $courseId);
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
            $course = $this->courseService->getCourseById($student->id, $courseId);
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
