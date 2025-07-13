<?php

namespace App\Repositories;

use App\Models\College;

class CollegeRepository extends BaseRepository
{
    public function __construct(College $college)
    {
        parent::__construct($college);
    }

    public function getAllWithDepartments(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->model->with('departments')->get();
    }
}
