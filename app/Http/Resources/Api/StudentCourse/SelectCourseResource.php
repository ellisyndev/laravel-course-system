<?php

namespace App\Http\Resources\Api\StudentCourse;

use App\Http\Resources\Api\Course\CourseResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SelectCourseResource extends JsonResource
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
            'course_id' => $this->course_id,
            'student_id' => $this->student_id,
            'status' => $this->status->value,
            'status_text' => $this->status->label(),
            'enrolled_at' => $this->enrolled_at?->format('Y-m-d H:i:s'),
            'withdrawn_at' => $this->withdrawn_at?->format('Y-m-d H:i:s'),
            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at?->format('Y-m-d H:i:s'),
        ], $this->detailed ? [
            'course' => new CourseResource($this->whenLoaded('course')),
        ] : []);
    }
}
