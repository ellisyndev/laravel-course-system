<?php

namespace App\Services\Api;

use App\Repositories\ClassroomRepository;
use App\Repositories\CollegeRepository;
use App\Repositories\DepartmentRepository;
use App\Repositories\TimeCodeRepository;
use App\Repositories\UserRepository;

class OptionService
{
    public function __construct(
        protected TimeCodeRepository $timeCodeRepository,
        protected CollegeRepository $collegeRepository,
        protected DepartmentRepository $departmentRepository,
        protected UserRepository $userRepository,
        protected ClassroomRepository $classroomRepository,
    ) {}

    /**
     * 取得時間代碼列表
     */
    public function getTimeCodes(): array
    {
        $codes = $this->timeCodeRepository->all();

        return $codes->map(function ($code) {
            return [
                'id' => $code->id,
                'code' => $code->code,
                'start_time' => $code->start_time,
                'end_time' => $code->end_time,
                'period' => $code->period,
            ];
        })->toArray();
    }

    /**
     * 取得學院列表
     */
    public function getColleges(): array
    {
        $data = $this->collegeRepository->all();

        return $data->map(function ($college) {
            return [
                'id' => $college->id,
                'code' => $college->code,
                'name' => $college->name,
            ];
        })->toArray();
    }

    /**
     * 取得系所列表
     */
    public function getDepartments(?int $collegeId = null): array
    {
        $data = $this->departmentRepository->getDepartmentsWihCollege($collegeId);

        return $data->map(function ($department) {
            return [
                'id' => $department->id,
                'code' => $department->code,
                'name' => $department->name,
            ];
        })->toArray();
    }

    /**
     * 取得學院與系所資料
     */
    public function collegesWithDepartments(): array
    {
        $data = $this->collegeRepository->getAllWithDepartments();

        return $data->map(function ($college) {
            return [
                'id' => $college->id,
                'code' => $college->code,
                'name' => $college->name,
                'departments' => $college->departments->map(function ($department) {
                    return [
                        'id' => $department->id,
                        'code' => $department->code,
                        'name' => $department->name,
                    ];
                })->toArray(),
            ];
        })->toArray();
    }

    /**
     * 取得教師列表
     */
    public function getTeachers(): array
    {
        $data = $this->userRepository->getTeachers();

        return $data->map(function ($teacher) {
            return [
                'id' => $teacher->id,
                'name' => $teacher->name,
            ];
        })->toArray();
    }

    /**
     * 取得教室列表
     */
    public function getClassrooms(): array
    {
        $data = $this->classroomRepository->all();

        return $data->map(function ($classroom) {
            return [
                'id' => $classroom->id,
                'code' => $classroom->code,
                'name' => $classroom->name,
            ];
        })->toArray();
    }

    /**
     * 取得學期列表
     */
    public function getSemesters(): array
    {
        $now = now();
        $year = $now->month >= 8 ? $now->year - 1911 : $now->year - 1911 - 1;
        $range = range($year - 2, $year + 2);

        return collect($range)
            ->flatMap(fn ($y) => ["{$y}-1", "{$y}-2"])
            ->map(fn ($code) => ['code' => $code])
            ->toArray();
    }
}
