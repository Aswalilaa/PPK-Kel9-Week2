<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskListMemberController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/tasksPage', [TaskController::class, 'tasksPage']);

Route::get('/lists/{list}', [TaskListMemberController::class, 'show'])->name('lists.show');
Route::post('/lists/{list}/members', [TaskListMemberController::class, 'addMember'])->name('lists.members.add');
Route::delete('/lists/{list}/members/{user}', [TaskListMemberController::class, 'removeMember'])->name('lists.members.remove');