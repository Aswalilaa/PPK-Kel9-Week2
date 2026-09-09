<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    // protected $fillable = ['task_list_id', 'title', 'is_completed'];

    // public function taskList()
    // {
    //     return $this->belongsTo(TaskList::class);
    // }

    protected $fillable = ['task_list_id', 'title', 'is_completed', 'user_id'];

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}