<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\ClassroomController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\SemesterController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\TimeCodeController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::post('auth/login', [AdminAuthController::class, 'login']);

Route::middleware(['auth:sanctum', 'admin.token'])->group(function () {
    Route::post('auth/logout', [AdminAuthController::class, 'logout']);
    Route::get('auth/profile', [AdminAuthController::class, 'profile']);
    Route::resource('semesters', SemesterController::class)
        ->only(['index', 'store', 'show', 'update', 'destroy']);
    Route::resource('time_codes', TimeCodeController::class)
        ->only(['index', 'store', 'show', 'update', 'destroy']);
    Route::resource('classrooms', ClassroomController::class)
        ->only(['index', 'store', 'show', 'update', 'destroy']);
    Route::resource('departments', DepartmentController::class)
        ->only(['index', 'store', 'show', 'update', 'destroy']);
    Route::resource('teachers', TeacherController::class)
        ->only(['index', 'store', 'show', 'update', 'destroy']);
    Route::resource('courses', CourseController::class)
        ->only(['index', 'store', 'show', 'update', 'destroy']);
    Route::resource('users', UserController::class)
        ->only(['index', 'show']);
});
