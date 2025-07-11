<?php

namespace App\Http\Resources\Course;

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
            'remarks' => $this->remarks,
            'max_students' => $this->max_students,

            // 教師資訊
            'teacher_name' => $this->teacher?->name,
            'teacher_email' => $this->teacher?->email,

            // 課程時間
            'start_time' => $this->startTime?->time,
            'end_time' => $this->endTime?->time,

            // 所屬單位
            'college_name' => $this->college?->name,
            'department_name' => $this->department?->name,
            'classroom_name' => $this->classroom_id ? $this->classroom?->name : '未定',

            // 其他
            'level_code' => $this->level_code,
            'semester_code' => $this->semester_code,
            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at?->format('Y-m-d H:i:s'),
        ], $this->detailed ? [
            'content' => $this->content,
        ] : []);
    }
}
