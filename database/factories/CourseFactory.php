<?php

namespace Database\Factories;

use App\Models\Classroom;
use App\Models\College;
use App\Models\Course;
use App\Models\Department;
use App\Models\TimeCode;
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
        $classroom = Classroom::inRandomOrder()->first();

        $timeCodeList = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', 'A', 'B', 'C', 'D'];
        $startIndex = $this->faker->numberBetween(0, count($timeCodeList) - 2);
        $endIndex = $this->faker->numberBetween($startIndex + 1, count($timeCodeList) - 1);

        $startCode = $timeCodeList[$startIndex];
        $endCode = $timeCodeList[$endIndex];

        return [
            'name'            => $this->faker->words(3, true),
            'description'     => $this->faker->sentence(),
            'content'         => $this->faker->paragraph(),
            'teacher_id'      => $teacher->id,
            'college_id'      => $college->id,
            'department_id'   => $department->id,
            'level_code'      => $this->faker->randomElement(['1', '2', '3', '4', 'A']),
            'classroom_id'    => $classroom?->id,
            'credit'          => $this->faker->randomElement([1, 2, 3]),
            'is_required'     => $this->faker->boolean(),
            'semester_code'   => '115-1',
            'max_students'    => $this->faker->numberBetween(30, 100),
            'remarks'         => $this->faker->optional()->sentence(),
            'weekday'         => $this->faker->numberBetween(1, 5), // 一到五
            'start_time_code' => $startCode,
            'end_time_code'   => $endCode,
            'is_english_taught' => $this->faker->boolean(20), // 20% 是全英授課
        ];
    }
}
