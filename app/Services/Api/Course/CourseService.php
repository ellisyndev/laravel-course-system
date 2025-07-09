<?php

namespace App\Services\Api\Course;

use App\Repositories\CourseRepository;
use Illuminate\Database\Eloquent\Model;

class CourseService
{
    public function __construct(protected CourseRepository $courseRepository) {
    }

    public function getCourseWithPagination(int $userId, array $filters = [], int $limit = 15): \Illuminate\Pagination\LengthAwarePaginator
    {
        return $this->courseRepository->getCourseWithPagination($filters, $limit);
    }

    public function createCourse(int $userId, array $data): Model
    {
        $data = $this->courseRepository->create($data);

        return $data;
    }
}
