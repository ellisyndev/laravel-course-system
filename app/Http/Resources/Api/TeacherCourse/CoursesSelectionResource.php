<?php

namespace App\Http\Resources\Api\TeacherCourse;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CoursesSelectionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            // 基本課程資訊
            'id' => $this->id,
            'code' => $this->code,
            'name' => $this->name,
            'description' => $this->description,
            'credit' => $this->credit,
            'is_required' => $this->is_required,
            'semester_code' => $this->semester_code,
            'teacher' => [
                'id' => $this->teacher?->id,
                'name' => $this->teacher?->name,
            ],
            'start_time_code' => $this->start_time_code,
            'end_time_code' => $this->end_time_code,
            'weekday' => $this->weekday,

            // 已加選人數
            'student_count' => $this->selections->count(),

            // 學生名單
            'students' => $this->selections
                ->map(fn ($selection) => [
                    'id' => $selection->student?->id,
                    'code' => $selection->student?->code,
                    'name' => $selection->student?->name,
                    'college_name' => $selection->student?->studentProfile?->college?->name,
                    'department_name' => $selection->student?->studentProfile?->department?->name,
                    'level_code' => $selection->student?->studentProfile?->grade,
                    'email' => $selection->student?->email,
                    'enrolled_at' => $selection->enrolled_at?->format('Y-m-d H:i:s'),
                ])
                ->filter()
                ->values(),
        ];
    }
}
