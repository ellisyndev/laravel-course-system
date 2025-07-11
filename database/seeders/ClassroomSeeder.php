<?php

namespace Database\Seeders;

use App\Models\Classroom;
use Illuminate\Database\Seeder;

class ClassroomSeeder extends Seeder
{
    public function run(): void
    {
        $classrooms = [
            ['code' => 'H101', 'name' => '普通教學館 101 教室', 'location' => '普通教學館 1 樓'],
            ['code' => 'H203', 'name' => '普通教學館 203 教室', 'location' => '普通教學館 2 樓'],
            ['code' => 'GE101', 'name' => '綜合教學館 GE101', 'location' => '綜合教學館 1 樓'],
            ['code' => 'GE202', 'name' => '綜合教學館 GE202', 'location' => '綜合教學館 2 樓'],
            ['code' => 'CSIE105', 'name' => '資工系館 105 教室', 'location' => '資訊工程學系館 1 樓'],
            ['code' => 'PH203', 'name' => '物理系館 203 教室', 'location' => '物理館 2 樓'],
            ['code' => 'LH202', 'name' => '文學院 LH202', 'location' => '文學院 2 樓'],
            ['code' => 'MG201', 'name' => '管理學院 MG201', 'location' => '管理學院 2 樓'],
            ['code' => 'ECON101', 'name' => '社科院 ECON101', 'location' => '社科院 1 樓'],
            ['code' => 'EDU301', 'name' => '教育學院 EDU301', 'location' => '教育學院 3 樓'],
        ];

        foreach ($classrooms as $room) {
            Classroom::firstOrCreate(['code' => $room['code']], [
                'name' => $room['name'],
                'location' => $room['location'],
            ]);
        }
    }
}
