<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskListController;
use App\Http\Controllers\TaskListMemberController;

Route::get('/', function () {
    return redirect()->route('task_lists.index');
});

Route::resource('task_lists', TaskListController::class);

Route::post('/task_lists/{task_list}/tasks', [TaskController::class, 'store'])->name('tasks.store');
Route::get('/task_lists/{task_list}/tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
Route::put('/task_lists/{task_list}/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
Route::delete('/task_lists/{task_list}/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');

// Existing Member Routes (Updated parameter to match task_list for consistency if desired, or keep as is)
Route::post('/lists/{list}/members', [TaskListMemberController::class, 'addMember'])->name('lists.members.add');
Route::delete('/lists/{list}/members/{user}', [TaskListMemberController::class, 'removeMember'])->name('lists.members.remove');