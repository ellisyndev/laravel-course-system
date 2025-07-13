<?php

namespace App\Repositories;

use App\Models\Classroom;

class ClassroomRepository extends BaseRepository
{
    public function __construct(Classroom $classroom)
    {
        parent::__construct($classroom);
    }

    /**
     * 取得所有教室資料
     */
    public function getClassroomWithPagination(array $filters): \Illuminate\Pagination\LengthAwarePaginator
    {
        $query = $this->model->newQuery();

        if (isset($filters['q'])) {
            $query->where(function ($q) use ($filters) {
                $q->where('name', 'like', '%'.$filters['q'].'%')
                    ->orWhere('code', 'like', '%'.$filters['q'].'%');
            });
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
}
