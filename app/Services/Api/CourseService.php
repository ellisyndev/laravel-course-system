<?php

namespace App\Services\Api;

use App\Repositories\CourseRepository;
use Illuminate\Database\Eloquent\Model;

class CourseService
{
    public function __construct(protected CourseRepository $courseRepository) {}

    public function getCourseWithPagination(
        int $userId,
        array $filters = [],
        int $limit = 15
    ): \Illuminate\Pagination\LengthAwarePaginator {
        return $this->courseRepository->getCourseWithPagination($filters, $limit);
    }

    public function getCourseById(int $userId, int $courseId): Model
    {
        return $this->courseRepository->findOrFail($courseId);
    }

    public function getCoursesByTeacherId(int $teacherId): \Illuminate\Database\Eloquent\Collection
    {
        return $this->courseRepository->getCoursesByTeacherId($teacherId);
    }

    public function getCourseWithEnrolledStudents(int $teacherId, int $courseId): ?\App\Models\Course
    {
        return $this->courseRepository->getCourseWithEnrolledStudents($teacherId, $courseId);
    }

    public function updateCourse(int $userId, int $courseId, array $data, bool $isAdmin = false): ?Model
    {
        return $this->courseRepository->updateCourse($userId, $courseId, $data, $isAdmin);
    }
}
