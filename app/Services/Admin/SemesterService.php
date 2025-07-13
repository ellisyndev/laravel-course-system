<?php

namespace App\Services\Admin;

use App\Repositories\SemesterRepository;

class SemesterService
{
    public function __construct(
        protected SemesterRepository $classroomRepository,
    ) {}

    public function getSemestersWithPagination(array $filters = []): \Illuminate\Pagination\LengthAwarePaginator
    {
        return $this->classroomRepository->getSemestersWithPagination($filters);
    }

    public function createSemester(array $data): \Illuminate\Database\Eloquent\Model
    {
        return $this->classroomRepository->createSemester($data);
    }

    public function getSemesterById(int $id): ?\Illuminate\Database\Eloquent\Model
    {
        return $this->classroomRepository->getSemesterById($id);
    }

    public function updateSemester(int $id, array $data): ?\Illuminate\Database\Eloquent\Model
    {
        return $this->classroomRepository->updateSemester($id, $data);
    }

    public function deleteSemester(int $id): bool
    {
        return $this->classroomRepository->deleteSemester($id);
    }
}
