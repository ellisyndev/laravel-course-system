<?php

namespace App\Services\Admin;

use App\Repositories\CourseRepository;
use Illuminate\Database\Eloquent\Model;

class CourseService
{
    public function __construct(
        protected CourseRepository $courseRepository) {}

    public function getCourseWithPagination(array $filters = [], int $limit = 15): \Illuminate\Pagination\LengthAwarePaginator
    {
        return $this->courseRepository->getCourseWithPagination($filters, $limit);
    }

    public function getCourseById(int $courseId): ?Model
    {
        return $this->courseRepository->findOrFail($courseId);
    }

    public function createCourse(int $userId, array $data): Model
    {
        $data = $this->courseRepository->create($data);

        return $data;
    }

    public function updateCourse(int $courseId, array $data): ?Model
    {
        $this->courseRepository->update($courseId, $data);

        return $this->courseRepository->find($courseId);
    }

    public function deleteCourse(int $courseId): bool
    {
        $course = $this->courseRepository->find($courseId);
        if (! $course) {
            abort(404, '課程不存在');
        }

        return $this->courseRepository->delete($courseId);
    }
}
