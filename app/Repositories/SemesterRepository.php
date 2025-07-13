<?php

namespace App\Repositories;

use App\Models\Semester;

class SemesterRepository extends BaseRepository
{
    public function __construct(Semester $semester)
    {
        parent::__construct($semester);
    }

    public function getSemestersWithPagination(array $filters = []): \Illuminate\Pagination\LengthAwarePaginator
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

    public function getSemesterById(int $id): ?\Illuminate\Database\Eloquent\Model
    {
        return $this->model->find($id);
    }

    public function createSemester(array $data): \Illuminate\Database\Eloquent\Model
    {
        return $this->model->create($data);
    }

    public function updateSemester(int $id, array $data): ?\Illuminate\Database\Eloquent\Model
    {
        $semester = $this->find($id);
        if (! $semester) {
            return null;
        }

        $semester->update($data);

        return $semester;
    }

    public function deleteSemester(int $id): bool
    {
        $semester = $this->find($id);
        if (! $semester) {
            return false;
        }

        return $semester->delete();
    }
}
