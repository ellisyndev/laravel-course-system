<?php

namespace App\Enums;

enum CourseSelectionStatus: string
{
    case Enrolled = 'enrolled';
    case Withdrawn = 'withdrawn';

    public function label(): string
    {
        return match ($this) {
            self::Enrolled => '已加選',
            self::Withdrawn => '已退選',
            default => 'N/A',
        };
    }
}
