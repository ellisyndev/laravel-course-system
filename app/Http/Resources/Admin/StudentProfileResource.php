<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentProfileResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'college' => $this->college->name ?? null,
            'department' => $this->department->name ?? null,
            'entry_year' => $this->entry_year,
            'grade' => $this->grade,
            'education_level' => $this->education_level,
            'program_type' => $this->program_type,
        ];
    }
}
