<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\OptionController;
use App\Http\Controllers\Api\StudentCourseController;
use App\Http\Controllers\Api\TeacherCourseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/auth/login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum', 'api.token'])->group(function () {
    Route::post('/auth/logout', [AuthController::class, 'logout']);
    Route::resource('courses', CourseController::class)->only(['index', 'show']);
    Route::prefix('options')->group(function () {
        Route::get('colleges_departments', [OptionController::class, 'collegesWithDepartments']);
        Route::get('colleges', [OptionController::class, 'colleges']);
        Route::get('departments', [OptionController::class, 'departments']);
        Route::get('teachers', [OptionController::class, 'teachers']);
        Route::get('classrooms', [OptionController::class, 'classrooms']);
        Route::get('semesters', [OptionController::class, 'semesters']);
        Route::get('time_codes', [OptionController::class, 'timeCodes']);
    });

    // 教師專區
    Route::middleware(['role:teacher'])->prefix('teacher')->group(function () {
        // 課程
        Route::resource('courses', TeacherCourseController::class)->only(['index', 'update']);
        // 取得課程學生列表
        Route::get('courses/{id}/students', [TeacherCourseController::class, 'getStudents']);
    });

    // 學生專區
    Route::middleware(['role:student'])->prefix('student')->group(function () {
        Route::prefix('courses')->group(function () {
            Route::get('/', [StudentCourseController::class, 'index']);
            // 選課
            Route::post('select', [StudentCourseController::class, 'select']);
            Route::post('cancel', [StudentCourseController::class, 'cancel']);
        });
    });
});
