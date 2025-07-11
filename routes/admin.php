<?php

use App\Http\Controllers\Admin\AdminAuthController;
use Illuminate\Support\Facades\Route;

Route::post('auth/login', [AdminAuthController::class, 'login']);

Route::middleware(['auth:sanctum', 'admin.token'])->group(function () {
    Route::post('auth/logout', [AdminAuthController::class, 'logout']);
    Route::get('auth/profile', [AdminAuthController::class, 'profile']);
});
