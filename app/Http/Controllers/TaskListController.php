<?php

namespace App\Http\Controllers;

use App\Models\TaskList;
use Illuminate\Http\Request;

class TaskListController extends Controller
{
    public function index()
    {
        $taskLists = TaskList::latest()->get();
        return view('task_lists.index', compact('taskLists'));
    }

    public function create()
    {
        return view('task_lists.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $taskList = TaskList::create($validated);

        return redirect()->route('task_lists.index')
            ->with('success', 'List created successfully.');
    }

    public function show(TaskList $taskList)
    {
        $taskList->load('tasks');
        return view('task_lists.show', compact('taskList'));
    }

    public function edit(TaskList $taskList)
    {
        return view('task_lists.edit', compact('taskList'));
    }

    public function update(Request $request, TaskList $taskList)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $taskList->update($validated);

        return redirect()->route('task_lists.index')
            ->with('success', 'List updated successfully.');
    }

    public function destroy(TaskList $taskList)
    {
        $taskList->delete();

        return redirect()->route('task_lists.index')
            ->with('success', 'List deleted successfully.');
    }
}
