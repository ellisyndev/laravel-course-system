<?php

namespace App\Services\Admin;

use App\Repositories\TimeCodeRepository;

class TimeCodeService
{
    public function __construct(protected TimeCodeRepository $timeCodeRepository) {}

    /**
     * 取得時間碼列表
     */
    public function getTimeCodesWithPagination(array $filters = []): \Illuminate\Pagination\LengthAwarePaginator
    {
        return $this->timeCodeRepository->getTimeCodesWithPagination($filters);
    }

    public function getTimeCodeById(?int $timeCodeId = null): ?\App\Models\TimeCode
    {
        return $this->timeCodeRepository->getTimeCodeById($timeCodeId);
    }

    /**
     * 新增時間碼
     */
    public function createTimeCode(array $data): \App\Models\TimeCode
    {
        return $this->timeCodeRepository->createTimeCode($data);
    }

    /**
     * 更新時間碼
     */
    public function updateTimeCode(int $id, array $data): ?\App\Models\TimeCode
    {
        $this->timeCodeRepository->update($id, $data);

        $timeCode = $this->timeCodeRepository->find($id);

        return $timeCode;
    }

    /**
     * 刪除時間碼
     */
    public function deleteTimeCode(int $id): bool
    {
        $timeCode = $this->timeCodeRepository->find($id);
        if (! $timeCode) {
            abort(404, '時間碼不存在');
        }

        return $this->timeCodeRepository->delete($id);
    }
}
