<?php

namespace App\Http\Resources\Api\Course;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
{
    protected bool $detailed = false;

    public function withDetail(): static
    {
        $this->detailed = true;

        return $this;
    }

    public function toArray(Request $request): array
    {
        return array_merge([
            'id' => $this->id,
            'code' => $this->code,
            'name' => $this->name,
            'description' => $this->description,
            'is_required' => $this->is_required ? '必修' : '選修',
            'credit' => $this->credit,
            'max_students' => $this->max_students,

            // 教師資訊
            'teacher_name' => $this->teacher?->name,
            'teacher_email' => $this->teacher?->email,

            // 課程時間
            'semester_code' => $this->semester_code,
            'start_time_code' => $this->start_time_code,
            'start_time' => optional($this->startTime)->start_time.'~'.optional($this->startTime)->end_time,
            'end_time_code' => $this->end_time_code,
            'end_time' => optional($this->endTime)->start_time.'~'.optional($this->endTime)->end_time,

            // 單位
            'college_code' => $this->college?->code,
            'college_name' => $this->college?->name,
            'department_code' => $this->department?->code,
            'department_name' => $this->department?->name,
            'level_code' => $this->level_code,
            'classroom_code' => $this->classroom?->code,
            'classroom_name' => $this->classroom_id ? $this->classroom?->name : '未定',

            // 其他
            'remarks' => $this->remarks,
            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at?->format('Y-m-d H:i:s'),
        ], $this->detailed ? [
            'content' => $this->content,
        ] : []);
    }
}
