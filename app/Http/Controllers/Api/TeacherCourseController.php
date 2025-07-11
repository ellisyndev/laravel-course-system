<?php

namespace App\Http\Controllers\Api;

use App\Enums\AdvancedApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\TeacherCourse\CreateCourseRequest;
use App\Services\Api\Course\CourseService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TeacherCourseController extends Controller
{
    use AdvancedApiResponseTrait;

    public function __construct(protected CourseService $coursetService)
    {
        //
    }

    public function index(Request $request): JsonResponse {}

    public function store(CreateCourseRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $user = $request->user();
        $validated['teacher_id'] = $user->id;

        if ($user->role !== 'teacher') {
            return $this->respondError('Only teachers can create courses', 403);
        }

        try {
            $course = $this->coursetService->createCourse($user->id, $validated);

            return $this->respondSuccess($course, 'Course created successfully');
        } catch (\Exception $e) {
            Log::error('CourseController@store', ['message' => $e->getMessage()]);

            return $this->respondError('Failed to create course'.$e->getMessage(), 500);
        }
    }

    public function update($id)
    {
        // 更新指定課程的邏輯
    }

    public function show($id)
    {
        // 返回指定課程的詳細信息
    }

    public function destroy($id)
    {
        // 刪除指定課程的邏輯
    }
}
