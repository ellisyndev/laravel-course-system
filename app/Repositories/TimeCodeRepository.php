<?php

namespace App\Repositories;

use App\Models\TimeCode;

class TimeCodeRepository extends BaseRepository
{
    public function __construct(TimeCode $timeCode)
    {
        parent::__construct($timeCode);
    }

    /**
     * 取得時間代碼列表
     */
    public function getTimeCodesWithPagination(array $filters = []): \Illuminate\Pagination\LengthAwarePaginator
    {
        $query = $this->model->query();

        if (isset($filters['q'])) {
            $query->where('name', 'like', '%'.$filters['q'].'%');
        }

        $sorting = $filters['sorting'] ?? 'id';
        $direction = $filters['direction'] ?? 'asc';

        $query->orderBy($sorting, $direction);

        $perPage = $filters['limit'] ?? 15;
        $page = $filters['page'] ?? 1;

        return $query->paginate(
            $perPage,
            ['*'],
            'page',
            $page
        );
    }

    /**
     * 取得單一時間代碼
     */
    public function getTimeCodeById(int $id): ?TimeCode
    {
        return $this->model->find($id);
    }

    /**
     * 新增時間代碼
     */
    public function createTimeCode(array $data): TimeCode
    {
        return $this->model->create($data);
    }

    /**
     * 更新時間代碼
     */
    public function updateTimeCode(int $id, array $data): ?TimeCode
    {
        $timeCode = $this->getTimeCodeById($id);
        if (! $timeCode) {
            return null;
        }

        $timeCode->update($data);

        return $timeCode;
    }

    /**
     * 刪除時間代碼
     */
    public function deleteTimeCode(int $id): bool
    {
        $timeCode = $this->getTimeCodeById($id);
        if (! $timeCode) {
            return false;
        }

        return $timeCode->delete();
    }
}
