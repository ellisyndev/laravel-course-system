<?php

namespace Database\Factories;

use App\Models\College;
use App\Models\Course;
use App\Models\Department;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    protected $model = Course::class;

    public function definition(): array
    {
        $teacher = User::factory()->create(['role' => 'teacher']);
        $college = College::inRandomOrder()->first();
        $department = Department::where('college_id', $college->id)->inRandomOrder()->first();

        return [
            'name' => $this->faker->words(3, true),
            'description' => $this->faker->sentence(),
            'content' => $this->faker->paragraph(),
            'teacher_id' => $teacher->id,
            'college_id' => $college->id,
            'department_id' => $department->id,
            'level_code' => $this->faker->randomElement(['1', '2', '3', '5', 'A']),
            'classroom_id' => null,
            'credit' => $this->faker->randomElement([1, 2, 3]),
            'is_required' => $this->faker->boolean(),
            'semester_code' => '115-1',
            'max_students' => $this->faker->numberBetween(20, 100),
            'remarks' => null,
            'code' => function (array $attributes) {
                // 產課程代碼
                $departmentCode = Department::find($attributes['department_id'])->code ?? 'XX';
                $levelCode = $attributes['level_code'] ?? '0'; // 若沒給預設為 0

                // 查出目前該系所、該學期、該等級已開設課程數量
                $serial = Course::where('department_id', $attributes['department_id'])
                    ->where('semester_code', $attributes['semester_code'])
                    ->count() + 1;

                $serialNumber = str_pad($serial, 3, '0', STR_PAD_LEFT); // 補滿三位數

                return "{$departmentCode}{$levelCode}{$serialNumber}";
            },
        ];
    }
}
