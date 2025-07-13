<?php

namespace App\Services\Admin;

use App\Repositories\DepartmentRepository;

class DepartmentService
{
    public function __construct(
        protected DepartmentRepository $departmentRepository
    ) {}

    /**
     * 取得系所列表
     */
    public function getDepartmentsWithPagination(array $filters = []): \Illuminate\Pagination\LengthAwarePaginator
    {
        return $this->departmentRepository->getDepartmentsWithPagination($filters);
    }

    public function getDepartmentById(?int $collegeId = null): ?\App\Models\Department
    {
        return $this->departmentRepository->getDepartmentById($collegeId);
    }

    /**
     * 新增系所資料
     */
    public function createDepartment(array $data): \Illuminate\Database\Eloquent\Model
    {
        return $this->departmentRepository->create($data);
    }

    /**
     * 更新系所資料
     */
    public function updateDepartment(int $id, array $data): ?\Illuminate\Database\Eloquent\Model
    {
        $this->departmentRepository->update($id, $data);

        $department = $this->departmentRepository->find($id);

        return $department;
    }

    /**
     * 刪除系所資料
     */
    public function deleteDepartment(int $id): bool
    {
        $department = $this->departmentRepository->find($id);
        if (! $department) {
            abort(404, '系所不存在');
        }

        return $this->departmentRepository->delete($id);
    }
}
