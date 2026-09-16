<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskList;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function store(Request $request, TaskList $taskList)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $taskList->tasks()->create([
            'title' => $validated['title'],
            'is_completed' => false,
            // 'user_id' => auth()->id() ?? 1 // if we had auth
        ]);

        return redirect()->route('task_lists.show', $taskList)
            ->with('success', 'Task created successfully.');
    }

    public function edit(TaskList $taskList, Task $task)
    {
        return view('tasks.edit', compact('taskList', 'task'));
    }

    public function update(Request $request, TaskList $taskList, Task $task)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'is_completed' => 'boolean',
        ]);

        $task->update([
            'title' => $validated['title'],
            'is_completed' => $request->has('is_completed'),
        ]);

        return redirect()->route('task_lists.show', $taskList)
            ->with('success', 'Task updated successfully.');
    }

    public function destroy(TaskList $taskList, Task $task)
    {
        $task->delete();
        
        return redirect()->route('task_lists.show', $taskList)
            ->with('success', 'Task deleted successfully.');
    }
}