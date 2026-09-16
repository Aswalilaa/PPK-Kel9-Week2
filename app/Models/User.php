<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Helper method untuk pengecekan role
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function taskLists()
    {
        return $this->belongsToMany(TaskList::class, 'task_list_members')
            ->withPivot('role')
            ->withTimestamps();
    }
}
