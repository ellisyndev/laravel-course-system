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
            ['code' => 'AR', 'name' => '文學院'],
            ['code' => 'SC', 'name' => '理學院'],
            ['code' => 'EN', 'name' => '工學院'],
            ['code' => 'MA', 'name' => '管理學院'],
            ['code' => 'SO', 'name' => '社會科學院'],
            ['code' => 'LA', 'name' => '法律學院'],
            ['code' => 'ME', 'name' => '醫學院'],
            ['code' => 'ED', 'name' => '教育學院'],
            ['code' => 'IN', 'name' => '國際事務學院'],
            ['code' => 'EE', 'name' => '電資學院'],
        ];

        foreach ($colleges as $item) {
            College::firstOrCreate(
                ['code' => $item['code']],
                ['name' => $item['name']]
            );
        }
    }
}
