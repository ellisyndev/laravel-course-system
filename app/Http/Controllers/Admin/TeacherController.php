<?php

namespace App\Http\Controllers\Admin;

use App\Enums\AdvancedApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Department\CreateDepartmentRequest;
use App\Http\Requests\Admin\Department\UpdateDepartmentRequest;
use App\Http\Resources\Admin\DepartmentResource;
use App\Services\Admin\TeacherService;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    use AdvancedApiResponseTrait;

    public function __construct(protected TeacherService $teacherService) {}

    /**
     * 取得教師列表
     */
    public function index(Request $request): \Illuminate\Http\JsonResponse
    {
        $filter = $request->only([
            'sorting', 'direction', 'page', 'limit', 'q',
        ]);
        $user = $request->user();

        try {
            $departments = $this->teacherService->getTeachersWithPagination($filter);

            return $this->apiResponse(DepartmentResource::collection($departments));
        } catch (\Exception $e) {
            return $this->respondError('取得列表失敗: '.$e->getMessage());
        }
    }

    /**
     * 新增教師資料
     */
    public function store(CreateDepartmentRequest $request)
    {
        try {
            $data = $request->validated();
            $classroom = $this->teacherService->createTeacher($data);

            return $this->respondSuccess(new DepartmentResource($classroom), '新增成功');
        } catch (\Exception $e) {
            return $this->respondError('新增失敗: '.$e->getMessage());
        }
    }

    /**
     * 取得單一教師資料
     */
    public function show($id)
    {
        try {
            $classroom = $this->teacherService->getTeacherById($id);

            return $this->respondSuccess(new DepartmentResource($classroom), '取得成功');
        } catch (\Exception $e) {
            return $this->respondError('取得失敗', ['id' => $id, 'message' => $e->getMessage()]);
        }
    }

    /**
     * 更新教師資料
     */
    public function update(UpdateDepartmentRequest $request, $id)
    {
        try {
            $data = $request->validated();
            $classroom = $this->teacherService->getTeacherById($id);

            if (! $classroom) {
                return $this->respondError('資料不存在', ['id' => $id]);
            }

            $classroom = $this->teacherService->updateTeacher($id, $data);

            return $this->respondSuccess(new DepartmentResource($classroom), '更新成功');
        } catch (\Exception $e) {
            return $this->respondError('更新失敗: '.$e->getMessage(), ['id' => $id]);
        }
    }

    /**
     * 刪除教師資料
     */
    public function destroy($id)
    {
        try {
            $data = $this->teacherService->deleteTeacher($id);

            if (! $data) {
                return $this->respondError('資料不存在或已被刪除', ['id' => $id]);
            }

            return $this->respondSuccess(null, '刪除成功');
        } catch (\Exception $e) {
            return $this->respondError('刪除失敗: '.$e->getMessage(), ['id' => $id]);
        }
    }
}
