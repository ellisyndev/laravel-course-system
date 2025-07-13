<?php

namespace App\Repositories;

use App\Models\Admin;

class AdminRepository extends BaseRepository
{
    public function __construct(Admin $admin)
    {
        parent::__construct($admin);
    }

    public function findWhere(array $conditions)
    {
        return $this->model->where($conditions)->get();
    }
}
