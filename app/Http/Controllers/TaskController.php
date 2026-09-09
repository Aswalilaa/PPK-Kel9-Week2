<?php

namespace App\Http\TaskControllers;
use Illuminate\Http\Request;
use App\Models\task_lists;
use App\Models\task;

class TaskController extends Controller
{
    // Lihat Semua Task (Tugas)
        public function tasksPage()
    {
        $tasks = tasks::all();

        return view('tasks.tasksPage', [
            'tasks' => $tasks
        ]
        );
    }
}