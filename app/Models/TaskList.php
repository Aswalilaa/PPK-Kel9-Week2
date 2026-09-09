<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskList extends Model
{   
    protected $fillable = ['name', 'owner_id'];

    public function members()
    {
        return $this->belongsToMany(User::class, 'task_list_members')
            ->withPivot('role')
            ->withTimestamps();
    }
    
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}