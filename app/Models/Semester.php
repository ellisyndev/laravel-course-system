<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    protected $fillable = [
        'code',
        'name',
        'year',
        'start_date',
        'end_date',
        'course_selection_start',
        'course_selection_end',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'course_selection_start' => 'datetime',
        'course_selection_end' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
