<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TimeCode extends Model
{
    protected $fillable = [
        'code',
        'start_time',
        'end_time',
        'status',
    ];

    protected $casts = [
        'start_time' => \App\Casts\HhmmToTime::class,
        'end_time' => \App\Casts\HhmmToTime::class,
    ];
}
