<?php

namespace App\Repositories;

use App\Models\Department;

class DepartmentRepository extends BaseRepository
{
    public function __construct(Department $department)
    {
        parent::__construct($department);
    }

    public function getDepartmentsWihCollege(?int $collegeId = null): \Illuminate\Database\Eloquent\Collection
    {
        $query = $this->model->with('college');

        if ($collegeId) {
            $query->where('college_id', $collegeId);
        }

        return $query->get();
    }

    public function getDepartmentsWithPagination(array $filters = []): \Illuminate\Pagination\LengthAwarePaginator
    {
        $query = $this->model->with('college');

        if (isset($filters['college_id'])) {
            $query->where('college_id', $filters['college_id']);
        }

        if (isset($filters['q'])) {
            $query->where(function ($q) use ($filters) {
                $q->where('name', 'like', '%'.$filters['q'].'%')
                    ->orWhere('code', 'like', '%'.$filters['q'].'%');
            });
        }

        return $query->paginate(10);
    }

    public function getDepartmentById(int $id): ?Department
    {
        return $this->model->with('college')->find($id);
    }

    public function createDepartment(array $data): Department
    {
        return $this->model->create($data);
    }

    public function updateDepartment(int $id, array $data): ?\Illuminate\Database\Eloquent\Model
    {
        $department = $this->find($id);
        if (! $department) {
            return null;
        }

        $department->update($data);

        return $department;
    }

    public function deleteDepartment(int $id): bool
    {
        $department = $this->find($id);
        if (! $department) {
            return false;
        }

        return $department->delete();
    }

    public function getAllWithColleges(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->model->with('college')->get();
    }
}
