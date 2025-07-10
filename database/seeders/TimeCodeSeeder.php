<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TimeCode;

class TimeCodeSeeder extends Seeder
{
    public function run(): void
    {
        $timeCodes = [
            ['code' => '0',  'time' => '0710'],
            ['code' => '1',  'time' => '0810'],
            ['code' => '2',  'time' => '0910'],
            ['code' => '3',  'time' => '1020'],
            ['code' => '4',  'time' => '1120'],
            ['code' => '5',  'time' => '1220'],
            ['code' => '6',  'time' => '1320'],
            ['code' => '7',  'time' => '1420'],
            ['code' => '8',  'time' => '1530'],
            ['code' => '9',  'time' => '1630'],
            ['code' => '10', 'time' => '1730'],
            ['code' => 'A',  'time' => '1825'],
            ['code' => 'B',  'time' => '1920'],
            ['code' => 'C',  'time' => '2015'],
            ['code' => 'D',  'time' => '2110'],
        ];

        foreach ($timeCodes as $data) {
            TimeCode::updateOrCreate(
                ['code' => $data['code']],
                ['time' => $data['time']]
            );
        }
    }
}
