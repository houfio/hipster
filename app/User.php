<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'id';

    public function exams()
    {
        return $this->belongsToMany(Exam::class, 'user_exams', 'exam_id');
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role', 'role');
    }

    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id', 'id');
    }
}
