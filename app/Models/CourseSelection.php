<?php

namespace App\Models;

use App\Enums\CourseSelectionStatus;
use Illuminate\Database\Eloquent\Model;

class CourseSelection extends Model
{
    protected $table = 'course_selections';

    protected $fillable = [
        'course_id',
        'student_id',
        'status',
        'created_at',
        'updated_at',
        'enrolled_at',
        'withdrawn_at',
    ];

    protected $casts = [
        'status' => CourseSelectionStatus::class,
        'enrolled_at' => 'datetime',
        'withdrawn_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function course(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function student(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'student_id');
    }
}
