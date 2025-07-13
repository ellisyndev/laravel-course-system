<?php

namespace App\Services\Admin;

use App\Repositories\TeacherRepository;

class TeacherService
{
    public function __construct(
        protected TeacherRepository $teacherRepository
    ) {}

    /**
     * 取得教師列表
     */
    public function getTeachersWithPagination(array $filters = []): \Illuminate\Pagination\LengthAwarePaginator
    {
        return $this->teacherRepository->getTeachersWithPagination($filters);
    }

    /**
     * 新增教師資料
     */
    public function createTeacher(array $data): \Illuminate\Database\Eloquent\Model
    {
        return $this->teacherRepository->create($data);
    }

    /**
     * 更新教師資料
     */
    public function updateTeacher(int $id, array $data): ?\Illuminate\Database\Eloquent\Model
    {
        $this->teacherRepository->update($id, $data);

        $classroom = $this->teacherRepository->find($id);

        return $classroom;
    }

    /**
     * 刪除教師資料
     */
    public function deleteTeacher(int $id): bool
    {
        $classroom = $this->teacherRepository->find($id);
        if (! $classroom) {
            abort(404, '教室不存在');
        }

        return $this->teacherRepository->delete($id);
    }

    public function getTeacherById(int $id)
    {
        $classroom = $this->teacherRepository->findOrFail($id);

        return $classroom;
    }
}
