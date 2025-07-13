<?php

namespace App\Http\Controllers\Admin;

use App\Enums\AdvancedApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Semester\CreateSemesterRequest;
use App\Http\Requests\Admin\Semester\UpdateSemesterRequest;
use App\Http\Resources\Admin\SemesterResource;
use App\Services\Admin\SemesterService;
use Illuminate\Http\Request;

class SemesterController extends Controller
{
    use AdvancedApiResponseTrait;

    public function __construct(protected SemesterService $semesterService) {}

    /**
     * 取得學期列表
     */
    public function index(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $filter = $request->only([
                'sorting', 'direction', 'page', 'limit', 'q',
            ]);
            $user = $request->user();
            $semesters = $this->semesterService->getSemestersWithPagination($filter);

            return $this->apiResponse(SemesterResource::collection($semesters));
        } catch (\Exception $e) {
            return $this->respondError('取得學期列表失敗: '.$e->getMessage());
        }
    }

    /**
     * 新增學期
     */
    public function store(CreateSemesterRequest $request): \Illuminate\Http\JsonResponse
    {
        try {
            $data = $request->validated();
            $user = $request->user();
            $semester = $this->semesterService->createSemester($data);

            return $this->respondSuccess(new SemesterResource($semester));
        } catch (\Exception $e) {
            return $this->respondError('新增學期失敗: '.$e->getMessage());
        }
    }

    /**
     * 取得單一學期資料
     */
    public function show(Request $request, int $id): \Illuminate\Http\JsonResponse
    {
        try {
            $user = $request->user();
            $semester = $this->semesterService->getSemesterById($id);

            return $this->apiResponse($semester);
        } catch (\Exception $e) {
            return $this->respondError('取得學期資料失敗: '.$e->getMessage());
        }
    }

    /**
     * 更新學期資料
     */
    public function update(UpdateSemesterRequest $request, int $id): \Illuminate\Http\JsonResponse
    {
        try {
            $data = $request->validated();
            $user = $request->user();
            $semester = $this->semesterService->updateSemester($id, $data);

            return $this->respondSuccess($semester, '更新學期成功');
        } catch (\Exception $e) {
            return $this->respondError('更新學期失敗: '.$e->getMessage());
        }
    }

    /**
     * 刪除學期資料
     */
    public function destroy(Request $request, int $id): \Illuminate\Http\JsonResponse
    {
        try {
            $user = $request->user();
            $this->semesterService->deleteSemester($id);

            return $this->respondSuccess(null, '刪除學期成功');
        } catch (\Exception $e) {
            return $this->respondError('刪除學期失敗: '.$e->getMessage());
        }
    }
}
