<?php

namespace App\Services\Admin;

use App\Repositories\ClassroomRepository;

class ClassroomService
{
    public function __construct(
        protected ClassroomRepository $classroomRepository,
    ) {}

    /**
     * 取得教室列表
     */
    public function getClassroomWithPagination($filters = []): \Illuminate\Pagination\LengthAwarePaginator
    {
        return $this->classroomRepository->getClassroomWithPagination($filters);
    }

    /**
     * 新增教室資料
     */
    public function createClassroom(array $data): \Illuminate\Database\Eloquent\Model
    {
        return $this->classroomRepository->create($data);
    }

    /**
     * 更新教室資料
     */
    public function updateClassroom(int $id, array $data): ?\Illuminate\Database\Eloquent\Model
    {
        $this->classroomRepository->update($id, $data);

        $classroom = $this->classroomRepository->find($id);

        return $classroom;
    }

    /**
     * 刪除教室資料
     */
    public function deleteClassroom(int $id): bool
    {
        $classroom = $this->classroomRepository->find($id);
        if (! $classroom) {
            abort(404, '教室不存在');
        }

        return $this->classroomRepository->delete($id);
    }

    public function getClassroomById(int $id)
    {
        $classroom = $this->classroomRepository->findOrFail($id);

        return $classroom;
    }
}
