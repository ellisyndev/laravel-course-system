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
}
