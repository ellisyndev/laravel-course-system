<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $profile = null;

        if ($this->role === 'student' && $this->relationLoaded('studentProfile')) {
            $profile = new StudentProfileResource($this->studentProfile);
        } elseif ($this->role === 'teacher' && $this->relationLoaded('teacherProfile')) {
            $profile = new TeacherProfileResource($this->teacherProfile);
        }

        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role,
            'profile' => $profile,
            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
        ];
    }
}
