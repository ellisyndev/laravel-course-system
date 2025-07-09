<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\StudentCourseController;
use App\Http\Controllers\Api\TeacherCourseController;
use App\Http\Controllers\Api\CourseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/auth/login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/auth/logout', [AuthController::class, 'logout']);
    Route::get('courses', [CourseController::class, 'index']);

    // 教師專區
    Route::middleware(['role:teacher'])->prefix('teacher')->group(function () {
        // 課程
        Route::resource('courses', TeacherCourseController::class)->only(['store', 'update']);
    });

    // 學生專區
    Route::middleware(['role:student'])->prefix('student')->group(function () {
        // 可選課程列表
        Route::get('courses/available', [StudentCourseController::class, 'availableCourses']);
        // 已選課程列表
        Route::get('courses/selected', [StudentCourseController::class, 'selectedCourses']);
        // 選課
        Route::post('courses/select', [StudentCourseController::class, 'select']);
        Route::post('courses/cancel', [StudentCourseController::class, 'cancel']);
    });
});
