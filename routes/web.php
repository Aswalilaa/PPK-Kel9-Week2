<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminUserController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskListController;
use App\Http\Controllers\TaskListMemberController;

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
    return redirect()->route('task_lists.index');

Route::resource('task_lists', TaskListController::class);

Route::post('/task_lists/{task_list}/tasks', [TaskController::class, 'store'])->name('tasks.store');
Route::get('/task_lists/{task_list}/tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
Route::put('/task_lists/{task_list}/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
Route::delete('/task_lists/{task_list}/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');

// Existing Member Routes (Updated parameter to match task_list for consistency if desired, or keep as is)
Route::post('/lists/{list}/members', [TaskListMemberController::class, 'addMember'])->name('lists.members.add');
Route::delete('/lists/{list}/members/{user}', [TaskListMemberController::class, 'removeMember'])->name('lists.members.remove');
Route::get('/tasksPage', [TaskController::class, 'tasksPage'])
    ->name('tasks.page');

// List

Route::get('/lists/{list}', [TaskListMemberController::class, 'show'])
    ->name('lists.show');

// Member

Route::post('/lists/{list}/members', [TaskListMemberController::class, 'addMember'])
    ->name('lists.members.add');

Route::delete('/lists/{list}/members/{user}', [TaskListMemberController::class, 'removeMember'])
    ->name('lists.members.remove');


// Task

// Tambah tugas
Route::post('/lists/{list}/tasks', [TaskController::class, 'store'])
    ->name('tasks.store');

// Edit tugas
Route::put('/tasks/{task}', [TaskController::class, 'update'])
    ->name('tasks.update');

// Hapus tugas
Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])
    ->name('tasks.destroy');

// Selesai / belum selesai
Route::patch('/tasks/{task}/toggle', [TaskController::class, 'toggle'])
    ->name('tasks.toggle');
