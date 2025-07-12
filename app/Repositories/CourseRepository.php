<?php

namespace App\Repositories;

use App\Models\Course;
use Illuminate\Pagination\LengthAwarePaginator;

class CourseRepository extends BaseRepository
{
    public function __construct(Course $course)
    {
        parent::__construct($course);
    }

    public function getCourseWithPagination(array $filter): LengthAwarePaginator
    {
        $model = $this->model->newQuery()->with('teacher', 'startTime', 'endTime');

        if (isset($filter['teacher_id'])) {
            $teacherId = $filter['teacher_id'] ?? null;
            $model->where('teacher_id', $teacherId);
        }

        if (isset($filter['is_required'])) {
            $isRequired = $filter['is_required'] ?? null;
            $model->where('is_required', $isRequired);
        }

        if (isset($filter['college_id'])) {
            $collegeId = $filter['college_id'] ?? null;
            $model->where('college_id', $collegeId);
        }

        if (isset($filter['department_id'])) {
            $departmentId = $filter['department_id'] ?? null;
            $model->where('department_id', $departmentId);
        }

        if (isset($filter['classroom_id'])) {
            $classroomId = $filter['classroom_id'] ?? null;
            $model->where('classroom_id', $classroomId);
        }

        if (isset($filter['level_code'])) {
            $levelCode = $filter['level_code'] ?? null;
            $model->where('level_code', $levelCode);
        }

        if (isset($filter['semester_code'])) {
            $semesterCode = $filter['semester_code'] ?? null;
            $model->where('semester_code', $semesterCode);
        }

        if (isset($filter['categories'])) {
            $categories = $filter['categories'] ?? [];
            $model->whereIn('category_id', $categories);
        }

        if (isset($filter['teacher_name'])) {
            $teacherName = $filter['teacher_name'] ?? '';
            $model->whereHas('teacher', function ($query) use ($teacherName) {
                $query->where('name', 'like', '%'.$teacherName.'%');
            });
        }

        if (isset($filter['course_code'])) {
            $courseCode = $filter['course_code'] ?? '';
            $model->where('code', 'like', '%'.$courseCode.'%');
        }

        if (isset($filter['q'])) {
            $searchTerm = $filter['q'] ?? '';
            $model->where(function ($query) use ($searchTerm) {
                $query->where('name', 'like', '%'.$searchTerm.'%')
                    ->orWhere('code', 'like', '%'.$searchTerm.'%');
            });
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

    /**
     * 取得並鎖定指定課程（避免同時加選）
     */
    public function findWithLock(int $courseId): ?Course
    {
        return $this->model
            ->newQuery()
            ->where('id', $courseId)
            ->lockForUpdate()
            ->first();
    }
}
