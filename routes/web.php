<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminUserController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth');
});

// Rute Publik
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Rute Terproteksi Autentikasi (User & Admin)
Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    // Rute Khusus Admin
    Route::middleware([AdminMiddleware::class])->prefix('admin')->group(function () {
        Route::post('/users', [AdminUserController::class, 'store']);
        Route::delete('/users/{id}', [AdminUserController::class, 'destroy']);
    });
});