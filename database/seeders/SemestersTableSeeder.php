<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SemestersTableSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();
        $currentYear = $now->year;
        $academicBase = 1911;

        $data = [];

        for ($y = $currentYear - 9; $y <= $currentYear; $y++) {
            $academicYear = $y - $academicBase;

            // 第 1 學期：9/1 ~ 隔年 1/15
            $start1 = Carbon::parse("{$y}-09-01");
            $end1 = Carbon::parse("{$y}-09-01")->addMonths(4)->day(15); // 約隔年 1/15

            $data[] = [
                'code' => "{$academicYear}-1",
                'name' => "{$academicYear} 學年度第 1 學期",
                'year' => $y,
                'start_date' => $start1->toDateString(),
                'end_date' => $end1->toDateString(),
                'course_selection_start' => $start1->copy()->subWeek()->toDateTimeString(),
                'course_selection_end' => $start1->copy()->addWeeks(2)->toDateTimeString(),
                'created_at' => now(),
                'updated_at' => now(),
            ];

            // 第 2 學期：2/10 ~ 6/30
            $start2 = Carbon::parse(($y + 1).'-02-10');
            $end2 = Carbon::parse(($y + 1).'-06-30');

            $data[] = [
                'code' => "{$academicYear}-2",
                'name' => "{$academicYear} 學年度第 2 學期",
                'year' => $y + 1,
                'start_date' => $start2->toDateString(),
                'end_date' => $end2->toDateString(),
                'course_selection_start' => $start2->copy()->subWeek()->toDateTimeString(),
                'course_selection_end' => $start2->copy()->addWeeks(2)->toDateTimeString(),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('semesters')->insert($data);
    }
}
