<?php

namespace App\Http\Controllers\Api;

use App\Enums\AdvancedApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TeacherCourse\UpdateCourseRequest;
use App\Http\Resources\Api\Course\CourseResource;
use App\Http\Resources\Api\TeacherCourse\CoursesSelectionResource;
use App\Services\Api\CourseService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TeacherCourseController extends Controller
{
    use AdvancedApiResponseTrait;

    public function __construct(protected CourseService $courseService)
    {
        //
    }

    public function index(Request $request): JsonResponse
    {
        $user = $request->user();

        if ($user->role !== 'teacher') {
            return $this->respondError('Only teachers can view courses', 403);
        }

        try {
            $courses = $this->courseService->getCoursesByTeacherId($user->id);

            return $this->apiResponse(
                CourseResource::collection($courses),
            );
        } catch (\Exception $e) {
            Log::error('TeacherCourseController@index', ['message' => $e->getMessage()]);

            return $this->respondError('Failed to retrieve courses: '.$e->getMessage(), 500);
        }
    }

    public function update(UpdateCourseRequest $request, int $courseId): JsonResponse
    {
        $user = request()->user();
        $data = $request->validated();

        if ($user->role !== 'teacher') {
            return $this->respondError('只有教師可修改課程', 403);
        }

        try {
            $course = $this->courseService->updateCourse($user->id, $courseId, $request->validated(), false);

            if (! $course) {
                return $this->respondError('課程不存在或無權限修改', 404);
            }

            return $this->respondSuccess(
                (new CourseResource($course))->withDetail(),
                '課程更新成功'
            );
        } catch (\Exception $e) {
            Log::error('TeacherCourseController@update', ['message' => $e->getMessage()]);

            return $this->respondError('課程更新失敗: '.$e->getMessage(), 500);
        }
    }

    public function getStudents(int $courseId): JsonResponse
    {
        $user = request()->user();

        if ($user->role !== 'teacher') {
            return $this->respondError('只有教師可查詢課程學生名單', 403);
        }

        $course = $this->courseService->getCourseWithEnrolledStudents($user->id, $courseId);

        if (! $course) {
            return $this->respondError('查無此課程或無權限查看', 404);
        }

        return $this->respondSuccess(
            new CoursesSelectionResource($course),
            '成功取得課程與學生名單'
        );
    }
}
