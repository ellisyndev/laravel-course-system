<?php

namespace App\Repositories;

use App\Models\CourseSelection;

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

    public function countEnrolledByCourseId(int $courseId): int
    {
        return $this->model->newQuery()
            ->where('course_id', $courseId)
            ->where('status', 'enrolled')
            ->count();
    }

    public function getCourseSelectionsByStudentId(int $studentId): \Illuminate\Database\Eloquent\Collection
    {
        return $this->model->newQuery()
            ->where('student_id', $studentId)
            ->with(['course', 'course.teacher'])
            ->where('status', 'enrolled')
            ->get();
    }
}
