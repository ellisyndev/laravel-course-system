<?php

namespace Database\Seeders;

use App\Models\TimeCode;
use Illuminate\Database\Seeder;

class TimeCodeSeeder extends Seeder
{
    public function run(): void
    {
        $timeSlots = [
            ['code' => '0',  'start' => '0710', 'end' => '0800', 'period' => 'morning'],
            ['code' => '1',  'start' => '0810', 'end' => '0900', 'period' => 'morning'],
            ['code' => '2',  'start' => '0910', 'end' => '1000', 'period' => 'morning'],
            ['code' => '3',  'start' => '1020', 'end' => '1110', 'period' => 'morning'],
            ['code' => '4',  'start' => '1120', 'end' => '1210', 'period' => 'morning'],
            ['code' => '5',  'start' => '1220', 'end' => '1310', 'period' => 'noon'],
            ['code' => '6',  'start' => '1320', 'end' => '1410', 'period' => 'afternoon'],
            ['code' => '7',  'start' => '1420', 'end' => '1510', 'period' => 'afternoon'],
            ['code' => '8',  'start' => '1530', 'end' => '1620', 'period' => 'afternoon'],
            ['code' => '9',  'start' => '1630', 'end' => '1720', 'period' => 'afternoon'],
            ['code' => '10', 'start' => '1730', 'end' => '1820', 'period' => 'afternoon'],
            ['code' => 'A',  'start' => '1825', 'end' => '1915', 'period' => 'evening'],
            ['code' => 'B',  'start' => '1920', 'end' => '2010', 'period' => 'evening'],
            ['code' => 'C',  'start' => '2015', 'end' => '2105', 'period' => 'evening'],
            ['code' => 'D',  'start' => '2110', 'end' => '2200', 'period' => 'evening'],
        ];

        foreach ($timeSlots as $slot) {
            TimeCode::updateOrCreate(
                ['code' => $slot['code']],
                ['start_time' => $slot['start'], 'end_time' => $slot['end'], 'period' => $slot['period']]
            );
        }
    }
}
