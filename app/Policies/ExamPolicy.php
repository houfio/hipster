<?php

namespace App\Policies;

use App\Exam;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ExamPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->role->name === 'admin';
    }

    public function view(User $user, Exam $exam)
    {
        return $user->role->name === 'admin';
    }

    public function create(User $user)
    {
        return $user->role->name === 'admin';
    }

    public function update(User $user, Exam $exam)
    {
        return $user->role->name === 'admin';
    }

    public function delete(User $user, Exam $exam)
    {
        return $user->role->name === 'admin';
    }
}
