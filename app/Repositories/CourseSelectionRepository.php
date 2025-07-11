<?php

namespace App\Repositories;

use App\Models\Course;
use App\Models\CourseSelection;
use Illuminate\Pagination\LengthAwarePaginator;

class CourseSelectionRepository extends BaseRepository
{
    public function __construct(CourseSelection $courseSelection)
    {
        parent::__construct($courseSelection);
    }

    public function findOneBy(array $conditions): ?CourseSelection
    {
        $query = $this->model->newQuery();

        foreach ($conditions as $key => $value) {
            if (is_array($value)) {
                $query->whereIn($key, $value);
            } else {
                $query->where($key, $value);
            }
        }

        return $query->first();
    }
}
