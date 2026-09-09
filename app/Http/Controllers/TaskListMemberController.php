<?php

namespace App\Http\Controllers;

use App\Models\TaskList;
use App\Models\User;
use Illuminate\Http\Request;

class TaskListMemberController extends Controller
{
   public function show(TaskList $list)
    {
        $list->load('members');
        $tasks = $list->tasks()->with('owner')->get();
        $totalTasks = $tasks->count();
        $completedTasks = $tasks->where('is_completed', true)->count();

        return view('lists.show', compact('list', 'tasks', 'totalTasks', 'completedTasks'));
    }

    public function addMember(Request $request, TaskList $list)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($list->members()->where('user_id', $user->id)->exists()) {
            return back()->with('error', 'User already a member.');
        }

        $list->members()->attach($user->id, ['role' => 'member']);

        return back()->with('success', 'Member added.');
    }

    public function removeMember(TaskList $list, User $user)
    {
        $list->members()->detach($user->id);
        return back()->with('success', 'Member removed.');
    }
    
}