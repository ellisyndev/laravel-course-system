<?php

namespace App\Http\Controllers\Admin;

use App\Enums\AdvancedApiResponseTrait;
use App\Http\Resources\Admin\TimeCodeResource;
use App\Services\Admin\TimeCodeService;
use Illuminate\Http\Request;

class TimeCodeController
{
    use AdvancedApiResponseTrait;

    public function __construct(protected TimeCodeService $timeCodeService) {}

    /**
     * 取得時間碼列表
     */
    public function index(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $filters = $request->only([
                'sorting', 'direction', 'page', 'limit', 'q',
            ]);
            $timeCodes = $this->timeCodeService->getTimeCodesWithPagination($filters);

            return $this->apiResponse(TimeCodeResource::collection($timeCodes));
        } catch (\Exception $e) {
            return $this->respondError('取得時間碼列表失敗: '.$e->getMessage());
        }
    }

    /**
     * 新增時間碼
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $data = $request->validate([
                'name' => 'required|string|max:255',
                'start_time' => 'required|date_format:H:i:s',
                'end_time' => 'required|date_format:H:i:s',
                'description' => 'nullable|string|max:1000',
            ]);
            $timeCode = $this->timeCodeService->createTimeCode($data);

            return $this->respondSuccess($timeCode, '新增時間碼成功');
        } catch (\Exception $e) {
            return $this->respondError('新增時間碼失敗: '.$e->getMessage());
        }
    }

    /**
     * 更新時間碼
     */
    public function update(Request $request, int $id): \Illuminate\Http\JsonResponse
    {
        try {
            $data = $request->validate([
                'name' => 'required|string|max:255',
                'start_time' => 'required|date_format:H:i:s',
                'end_time' => 'required|date_format:H:i:s',
                'description' => 'nullable|string|max:1000',
            ]);
            $timeCode = $this->timeCodeService->updateTimeCode($id, $data);

            return $this->respondSuccess($timeCode, '更新時間碼成功');
        } catch (\Exception $e) {
            return $this->respondError('更新時間碼失敗: '.$e->getMessage());
        }
    }

    /**
     * 刪除時間碼
     */
    public function destroy(int $id): \Illuminate\Http\JsonResponse
    {
        try {
            $this->timeCodeService->deleteTimeCode($id);

            return $this->respondSuccess(null, '刪除時間碼成功');
        } catch (\Exception $e) {
            return $this->respondError('刪除時間碼失敗: '.$e->getMessage());
        }
    }
}
