<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskListMemberController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/tasksPage', [TaskController::class, 'tasksPage'])
    ->name('tasks.page');


/*
|--------------------------------------------------------------------------
| List
|--------------------------------------------------------------------------
*/

Route::get('/lists/{list}', [TaskListMemberController::class, 'show'])
    ->name('lists.show');


/*
|--------------------------------------------------------------------------
| Member
|--------------------------------------------------------------------------
*/

Route::post('/lists/{list}/members', [TaskListMemberController::class, 'addMember'])
    ->name('lists.members.add');

Route::delete('/lists/{list}/members/{user}', [TaskListMemberController::class, 'removeMember'])
    ->name('lists.members.remove');


/*
|--------------------------------------------------------------------------
| Task
|--------------------------------------------------------------------------
*/

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