<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository extends BaseRepository
{
    public function __construct(User $user)
    {
        parent::__construct($user);
    }

    public function findWhere(array $conditions)
    {
        return $this->model->where($conditions)->get();
    }

    public function getTeachers(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->model->where('role', 'teacher')->get();
    }
}
