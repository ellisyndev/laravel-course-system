<?php

namespace App\Http\Resources\Admin;

namespace App\Http\Resources\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TeacherProfileResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'college' => $this->college->name ?? null,
            'department' => $this->department->name ?? null,
            'title' => $this->title,
            'office' => $this->office,
            'phone_ext' => $this->phone_ext,
            'expertise' => $this->expertise,
        ];
    }
}
