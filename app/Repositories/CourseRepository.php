<?php

namespace App\Repositories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class CourseRepository extends BaseRepository
{
    public function __construct(Course $course)
    {
        parent::__construct($course);
    }

    public function getCourseWithPagination(array $filter): LengthAwarePaginator
    {
        $model = $this->model->newQuery();

        if (isset($filter['teacher_id'])) {
            $teacherId = $filter['teacher_id'] ?? null;
            $model->where('teacher_id', $teacherId);
        }

        if (isset($filter['is_required'])) {
            $isRequired = $filter['is_required'] ?? null;
            $model->where('is_required', $isRequired);
        }

        $sorting = $filter['sorting'] ?? 'id';
        $direction = $filter['direction'] ?? 'asc';

        $model->orderBy($sorting, $direction);

        $perPage = $filter['per_page'] ?? 15;
        $page = $filter['page'] ?? 1;


        return $model->paginate(
            $perPage,
            ['*'],
            'page',
            $page
        );
    }
}
