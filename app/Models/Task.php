<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'task_list_id',
        'title',
        'priority',
        'deadline',
        'is_completed',
        'user_id'
    ];

    protected $casts = [
        'deadline' => 'datetime',
        'is_completed' => 'boolean',
    ];

    public function taskList()
    {
        return $this->belongsTo(TaskList::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}