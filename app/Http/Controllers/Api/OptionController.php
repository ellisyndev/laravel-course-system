<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\College;
use App\Models\Department;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OptionController extends Controller
{
    public function colleges()
    {
        return response()->json([
            'data' => College::select('id', 'name')->get(),
        ]);
    }

    public function departments(Request $request)
    {
        $query = Department::query()->select('id', 'name');

        if ($request->filled('college_id')) {
            $query->where('college_id', $request->college_id);
        }

        return response()->json([
            'data' => $query->get(),
        ]);
    }

    public function collegesWithDepartments()
    {
        $colleges = \App\Models\College::with(['departments:id,college_id,code,name'])
            ->select('id', 'code', 'name')
            ->get();

        return response()->json([
            'data' => $colleges,
        ]);
    }

    public function teachers()
    {
        return response()->json([
            'data' => User::where('role', 'teacher')->select('id', 'name')->get(),
        ]);
    }

    public function classrooms()
    {
        return response()->json([
            'data' => Classroom::select('id', 'name')->get(),
        ]);
    }

    public function semesters()
    {
        $now = Carbon::now();

        // 取得目前學年度
        $year = $now->month >= 8 ? $now->year - 1911 : $now->year - 1911 - 1;

        // 設定產出範圍（前 2 年到後 2 年，共 5 年）
        $range = range($year - 2, $year + 2);

        $semesters = collect($range)
            ->flatMap(fn ($y) => ["{$y}-1", "{$y}-2"]);

        return response()->json([
            'data' => $semesters->map(fn ($code) => ['code' => $code]),
        ]);
    }

    public function timeCodes()
    {
        $data = \App\Models\TimeCode::select('code', 'time', 'period')
            ->get()
            ->map(function ($item) {
                return [
                    'code' => $item->code,
                    'time' => $item->time,
                    'period' => $item->period,
                ];
            });

        return response()->json([
            'code' => 200,
            'message' => '操作成功',
            'data' => $data,
        ]);
    }
}
