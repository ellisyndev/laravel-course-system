<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    protected static ?string $password = null;

    public function definition(): array
    {
        $role = $this->faker->randomElement(['student', 'teacher']);

        $code = $this->generateUniqueCode($role);

        return [
            'code' => $code,
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => Hash::make('password1'),
            'remember_token' => Str::random(10),
            'role' => $role,
        ];
    }

    protected function generateUniqueCode(string $role): string
    {
        $prefix = $role === 'student' ? 'S' : 'T';
        $timestamp = now()->format('His'); // 時:分:秒
        $random = rand(100, 999);          // 三位亂數

        return $prefix.$timestamp.$random;
    }

    public function student(): static
    {
        return $this->state(function () {
            return [
                'role' => 'student',
                'code' => $this->generateUniqueCode('student'),
            ];
        });
    }

    public function teacher(): static
    {
        return $this->state(function () {
            return [
                'role' => 'teacher',
                'code' => $this->generateUniqueCode('teacher'),
            ];
        });
    }
}
