<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskList;
use Illuminate\Http\Request;

class TaskController extends Controller
{
<<<<<<< HEAD
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
=======
    // Menampilkan semua tugas
    public function tasksPage()
    {
        $tasks = Task::all();

        return view('tasks.tasksPage', [
            'tasks' => $tasks
        ]);
    }

    // Menambahkan tugas ke dalam daftar
    public function store(Request $request, TaskList $list)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'priority' => 'required|in:rendah,sedang,tinggi',
            'deadline' => 'nullable|date',
        ]);

        Task::create([
            'task_list_id' => $list->id,
            'title' => $request->title,
            'priority' => $request->priority,
            'deadline' => $request->deadline,
            'is_completed' => false,
        ]);

        return redirect()
            ->route('lists.show', $list->id)
            ->with('success', 'Tugas berhasil ditambahkan.');
    }

    // Mengedit tugas
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'priority' => 'required|in:rendah,sedang,tinggi',
            'deadline' => 'nullable|date',
        ]);

        $task->update([
            'title' => $request->title,
            'priority' => $request->priority,
            'deadline' => $request->deadline,
        ]);

        return redirect()
            ->route('lists.show', $task->task_list_id)
            ->with('success', 'Tugas berhasil diperbarui.');
    }

    // Menghapus tugas
    public function destroy(Task $task)
    {
        $listId = $task->task_list_id;

        $task->delete();

        return redirect()
            ->route('lists.show', $listId)
            ->with('success', 'Tugas berhasil dihapus.');
    }

    // Mengubah status selesai/belum selesai
    public function toggle(Task $task)
    {
        $task->update([
            'is_completed' => !$task->is_completed
        ]);

        return redirect()
            ->route('lists.show', $task->task_list_id)
            ->with('success', 'Status tugas berhasil diubah.');
>>>>>>> 6367d34711170d9c8fbd4dad8d6123f90a40b710
    }
}