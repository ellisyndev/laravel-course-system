<?php

namespace App\Http\Resources\StudentCourse;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SelectCourseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'course_id' => $this->course_id,
            'student_id' => $this->student_id,
            'status' => $this->status,
            'enrolled_at' => $this->enrolled_at->toDateTimeString(),
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
        ];
    }
}
