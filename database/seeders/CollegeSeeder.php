<?php

namespace Database\Seeders;

use App\Models\College;
use Illuminate\Database\Seeder;

class CollegeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $colleges = [
            '文學院',
            '理學院',
            '工學院',
            '管理學院',
            '社會科學院',
            '法律學院',
            '醫學院',
            '教育學院',
            '國際事務學院',
            '電資學院',
        ];

        foreach ($colleges as $name) {
            College::firstOrCreate(['name' => $name]);
        }
    }
}
