<?php

namespace Database\Seeders;

use App\Models\College;
use App\Models\Department;
use App\Models\StudentProfile;
use App\Models\TeacherProfile;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $teacherLastNames = ['陳', '林', '黃', '張', '李', '王', '吳', '劉', '蔡', '楊'];
        $teacherFirstNames = ['志明', '志強', '俊雄', '玉珍', '秀琴', '麗華', '玉梅', '美玲', '美珍', '秋月'];

        $studentLastNames = ['陳', '林', '黃', '張', '李', '王', '吳', '劉', '蔡', '楊'];
        $studentFirstNames = ['子涵', '品妤', '宥辰', '家豪', '宇軒', '芷妍', '昱廷', '語彤', '柏翰', '怡安'];

        $departments = Department::pluck('id')->all();
        $colleges = College::pluck('id')->all();

        // 建立學生
        foreach (range(1, 10) as $i) {
            $code = 'S'.str_pad($i, 7, '0', STR_PAD_LEFT);
            $name = $studentLastNames[array_rand($studentLastNames)].$studentFirstNames[array_rand($studentFirstNames)];

            $user = User::create([
                'code' => $code,
                'name' => $name,
                'email' => $code.'@demo.edu.tw',
                'password' => Hash::make('Password!123'),
                'role' => 'student',
                'email_verified_at' => now(),
            ]);

            StudentProfile::create([
                'user_id' => $user->id,
                'college_id' => $colleges ? $colleges[array_rand($colleges)] : null,
                'department_id' => $departments ? $departments[array_rand($departments)] : null,
                'entry_year' => now()->year - rand(0, 3), // 模擬大一～大四
                'education_level' => 'bachelor',
                'program_type' => ['day', 'night', 'inservice'][rand(0, 2)],
            ]);
        }

        // 建立教師
        foreach (range(1, 10) as $i) {
            $code = 'T'.str_pad($i, 7, '0', STR_PAD_LEFT);
            $name = $teacherLastNames[array_rand($teacherLastNames)].$teacherFirstNames[array_rand($teacherFirstNames)];

            $user = User::create([
                'code' => $code,
                'name' => $name,
                'email' => $code.'@demo.edu.tw',
                'password' => Hash::make('Password!123'),
                'role' => 'teacher',
                'email_verified_at' => now(),
            ]);

            TeacherProfile::create([
                'user_id' => $user->id,
                'department_id' => $departments ? $departments[array_rand($departments)] : null,
                'college_id' => $colleges ? $colleges[array_rand($colleges)] : null,
                'title' => ['professor', 'associate_professor', 'lecturer'][rand(0, 2)],
                'office' => 'H'.rand(401, 419),
                'phone_ext' => '7'.rand(100, 999),
                'expertise' => '人工智慧、資料科學',
            ]);
        }
    }
}
