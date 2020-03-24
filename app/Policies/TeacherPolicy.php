<?php

namespace App\Policies;

use App\Teacher;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TeacherPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->role->name === 'admin';
    }

    public function view(User $user, Teacher $teacher)
    {
        return $user->role->name === 'admin';
    }

    public function create(User $user)
    {
        return $user->role->name === 'admin';
    }

    public function update(User $user, Teacher $teacher)
    {
        return $user->role->name === 'admin';
    }

    public function delete(User $user, Teacher $teacher)
    {
        return $user->role->name === 'admin';
    }
}
