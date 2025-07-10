<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $table = 'courses';

    protected $fillable = [
        'name',
        'description',
        'content',
        'teacher_id',
        'college_id',
        'department_id',
        'level_code',
        'classroom_id',
        'credit',
        'is_required',
        'semester_code',
        'max_students',
        'remarks',
        'code',
        'start_time_code',
        'end_time_code',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function (Course $course) {
            if (empty($course->code)) {
                $course->code = self::generateCourseCode($course);
            }
        });
    }

    private static function generateCourseCode(Course $course): string
    {
        // 取得系所代碼
        $department = Department::find($course->department_id);
        $departmentCode = $department?->code ?? 'XX';
        $levelCode = $course->level_code ?? '0'; // 若沒給預設為 0

        // 查出目前該系所、該學期、該等級已開設課程數量
        $serial = self::where('department_id', $course->department_id)
                ->where('semester_code', $course->semester_code)
                ->count() + 1;

        $serialNumber = str_pad($serial, 3, '0', STR_PAD_LEFT); // 補滿三位數

        return "{$departmentCode}{$levelCode}{$serialNumber}";
    }

    public function teacher(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function college(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(College::class);
    }

    public function department(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function classroom(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Classroom::class);
    }

    public function students(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(User::class, 'course_student', 'course_id', 'student_id')
                    ->withTimestamps();
    }

    public function startTime(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(TimeCode::class, 'start_time_code', 'code');
    }

    public function endTime(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(TimeCode::class, 'end_time_code', 'code');
    }
}
