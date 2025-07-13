<?php

namespace App\Http\Controllers\Admin;

use App\Enums\AdvancedApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Department\CreateDepartmentRequest;
use App\Http\Requests\Admin\Department\UpdateDepartmentRequest;
use App\Http\Resources\Admin\DepartmentResource;
use App\Services\Admin\DepartmentService;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    use AdvancedApiResponseTrait;

    public function __construct(protected DepartmentService $departmentService) {}

    /**
     * 取得系所列表
     */
    public function index(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $filter = $request->only([
                'sorting', 'direction', 'page', 'limit', 'q',
            ]);
            $user = $request->user();
            $departments = $this->departmentService->getDepartmentsWithPagination($filter);

            return $this->apiResponse(DepartmentResource::collection($departments));
        } catch (\Exception $e) {
            return $this->respondError('取得列表失敗: '.$e->getMessage());
        }
    }

    /**
     * 新增系所資料
     */
    public function store(CreateDepartmentRequest $request)
    {
        try {
            $data = $request->validated();
            $user = $request->user();
            $classroom = $this->departmentService->createDepartment($data);

            return $this->respondSuccess(new DepartmentResource($classroom), '新增成功');
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
            $user = $request->user();
            $classroom = $this->departmentService->getDepartmentById($id);

            return $this->respondSuccess(new DepartmentResource($classroom), '取得成功');
        } catch (\Exception $e) {
            return $this->respondError('取得失敗', ['id' => $id, 'message' => $e->getMessage()]);
        }
    }

    /**
     * 更新教室資料
     */
    public function update(UpdateDepartmentRequest $request, $id)
    {
        try {
            $data = $request->validated();
            $user = $request->user();
            $classroom = $this->departmentService->getDepartmentById($id);

            if (! $classroom) {
                return $this->respondError('資料不存在', ['id' => $id]);
            }

            $classroom = $this->departmentService->updateDepartment($id, $data);

            return $this->respondSuccess(new DepartmentResource($classroom), '更新成功');
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
            $data = $this->departmentService->deleteDepartment($id);

            if (! $data) {
                return $this->respondError('資料不存在或已被刪除', ['id' => $id]);
            }

            return $this->respondSuccess(null, '刪除成功');
        } catch (\Exception $e) {
            return $this->respondError('刪除失敗: '.$e->getMessage(), ['id' => $id]);
        }
    }
}
