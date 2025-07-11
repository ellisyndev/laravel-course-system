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
        'weekday',
        'start_time_code',
        'end_time_code',
        'is_english_taught',
    ];

    protected $casts = [
        'is_required' => 'boolean',
        'credit' => 'integer',
        'max_students' => 'integer',
        'start_time_code' => 'string',
        'end_time_code' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
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
        // 取得系所代碼與年級代碼
        $department = Department::find($course->department_id);
        $departmentCode = $department?->code ?? 'XX';
        $levelCode = $course->level_code ?? '0';

        // 找出該系所、學期、年級，現有最大的課程代碼
        $latestCode = self::where('department_id', $course->department_id)
            ->where('semester_code', $course->semester_code)
            ->where('level_code', $course->level_code)
            ->orderByDesc('code')
            ->value('code');

        // 從課程代碼中擷取最後三碼作為 serial
        if ($latestCode && preg_match('/(\d{3})$/', $latestCode, $matches)) {
            $serial = (int) $matches[1] + 1;
        } else {
            $serial = 1;
        }

        // 補滿三位數
        $serialNumber = str_pad($serial, 3, '0', STR_PAD_LEFT);

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
        return $this->belongsToMany(User::class, 'course_selections', 'course_id', 'student_id')
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
