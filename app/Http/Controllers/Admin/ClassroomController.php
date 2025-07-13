<?php

namespace App\Http\Controllers\Admin;

use App\Enums\AdvancedApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Classroom\CreateClassroomRequest;
use App\Http\Requests\Admin\Classroom\UpdaeClassroomRequest;
use App\Http\Resources\Admin\ClassroomResource;
use App\Services\Admin\ClassroomService;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    use AdvancedApiResponseTrait;

    public function __construct(protected ClassroomService $classroomService) {}

    /**
     * 取得教室列表
     */
    public function index(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $filter = $request->only([
                'sorting', 'direction', 'page', 'limit', 'q',
            ]);
            $user = $request->user();
            $data = $this->classroomService->getClassroomWithPagination($filter);

            return $this->apiResponse(ClassroomResource::collection($data));
        } catch (\Exception $e) {
            return $this->respondError('取得列表失敗: '.$e->getMessage());
        }
    }

    /**
     * 新增教室資料
     */
    public function store(CreateClassroomRequest $request)
    {
        try {
            $user = $request->user();
            $validated = $request->validated();
            $classroom = $this->classroomService->createClassroom($validated);

            return $this->respondSuccess(new ClassroomResource($classroom), '新增成功');
        } catch (\Exception $e) {
            return $this->respondError('新增失敗: '.$e->getMessage());
        }
    }

    /**
     * 取得單一教室資料
     */
    public function show(Request $request, $id)
    {
        try {
            $classroom = $this->classroomService->getClassroomById($id);

            return $this->respondSuccess(new ClassroomResource($classroom), '取得成功');
        } catch (\Exception $e) {
            return $this->respondError('取得失敗', ['id' => $id, 'message' => $e->getMessage()]);
        }
    }

    /**
     * 更新教室資料
     */
    public function update(UpdaeClassroomRequest $request, $id)
    {
        try {
            $data = $request->validated();
            $user = $request->user();
            $classroom = $this->classroomService->getClassroomById($id);

            if (! $classroom) {
                return $this->respondError('資料不存在', ['id' => $id]);
            }

            $classroom = $this->classroomService->updateClassroom($id, $data);

            return $this->respondSuccess(new ClassroomResource($classroom), '更新成功');
        } catch (\Exception $e) {
            return $this->respondError('更新失敗: '.$e->getMessage(), ['id' => $id]);
        }
    }

    /**
     * 刪除教室資料
     */
    public function destroy(Request $request, $id)
    {
        try {
            $user = $request->user();
            $data = $this->classroomService->deleteClassroom($id);

            if (! $data) {
                return $this->respondError('資料不存在或已被刪除', ['id' => $id]);
            }

            return $this->respondSuccess(null, '刪除成功');
        } catch (\Exception $e) {
            return $this->respondError('刪除失敗: '.$e->getMessage(), ['id' => $id]);
        }
    }
}
