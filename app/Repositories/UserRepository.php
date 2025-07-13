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

    public function getUsersWithPagination(array $filters = []): \Illuminate\Pagination\LengthAwarePaginator
    {
        $query = $this->model->newQuery()->with(['studentProfile', 'teacherProfile']);

        if (isset($filters['role'])) {
            $query->where('role', $filters['role']);
        }

        if (isset($filters['q'])) {
            $query->where(function ($q) use ($filters) {
                $q->where('name', 'like', '%'.$filters['q'].'%')
                    ->orWhere('email', 'like', '%'.$filters['q'].'%');
            });
        }

        return $query->paginate(10);
    }

    public function getUserById(int $id): ?User
    {
        return $this->model->with(['studentProfile', 'teacherProfile'])->find($id);
    }
}
