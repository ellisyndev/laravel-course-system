<?php

namespace App\Http\Controllers\Admin;

use App\Enums\AdvancedApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateCourseRequest;
use App\Http\Requests\Admin\UpdateCourseRequest;
use App\Http\Resources\Api\Course\CourseResource;
use App\Services\Admin\CourseService;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    use AdvancedApiResponseTrait;

    public function __construct(protected CourseService $courseService) {}

    /**
     * 取得課程列表
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $filters = $request->only(['page', 'limit', 'sorting', 'direction', 'title', 'status']);

        try {
            $courses = $this->courseService->getCourseWithPagination($filters);

            return $this->apiResponse(CourseResource::collection($courses));
        } catch (\Exception $e) {
            return $this->respondError('取得課程列表失敗: '.$e->getMessage());
        }
    }

    /**
     * 新增課程
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateCourseRequest $request)
    {
        $data = $request->validated();
        $user = $request->user();

        try {
            $course = $this->courseService->createCourse($user->id, $data);

            return $this->respondSuccess($course, '課程新增成功');
        } catch (\Exception $e) {
            return $this->respondError('課程新增失敗: '.$e->getMessage());
        }
    }

    /**
     * 取得單一課程
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id)
    {
        try {
            $course = $this->courseService->getCourseById($id);

            if (! $course) {
                return $this->respondError('課程不存在', 404);
            }

            return $this->respondSuccess($course, '取得課程成功');
        } catch (\Exception $e) {
            return $this->respondError('取得課程失敗: '.$e->getMessage());
        }
    }

    /**
     * 更新課程
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateCourseRequest $request, int $id)
    {
        $data = $request->validated();
        $user = $request->user();

        try {
            $course = $this->courseService->updateCourse($id, $data);

            if (! $course) {
                return $this->respondError('課程不存在', 404);
            }

            return $this->respondSuccess($course, '課程更新成功');
        } catch (\Exception $e) {
            return $this->respondError('課程更新失敗: '.$e->getMessage());
        }
    }

    /**
     * 刪除課程
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $id)
    {
        try {
            $deleted = $this->courseService->deleteCourse($id);

            if (! $deleted) {
                return $this->respondError('課程不存在', 404);
            }

            return $this->respondSuccess(null, '課程刪除成功');
        } catch (\Exception $e) {
            return $this->respondError('課程刪除失敗: '.$e->getMessage());
        }
    }
}
