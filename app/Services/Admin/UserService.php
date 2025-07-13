<?php

namespace App\Services\Admin;

use App\Repositories\UserRepository;

class UserService
{
    public function __construct(
        protected UserRepository $userRepository
    ) {}

    /**
     * 取得使用者列表
     */
    public function getUsersWithPagination(array $filters = []): \Illuminate\Pagination\LengthAwarePaginator
    {
        return $this->userRepository->getUsersWithPagination($filters);
    }

    /**
     * 取得單一使用者資料
     */
    public function getUserById(int $id): ?\Illuminate\Database\Eloquent\Model
    {
        return $this->userRepository->getUserById($id);
    }
}
