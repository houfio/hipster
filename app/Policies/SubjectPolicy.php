<?php

namespace App\Policies;

use App\Subject;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SubjectPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->role->name === 'admin';
    }

    public function view(User $user, Subject $subject)
    {
        return $user->role->name === 'admin';
    }

    public function create(User $user)
    {
        return $user->role->name === 'admin';
    }

    public function update(User $user, Subject $subject)
    {
        return $user->role->name === 'admin';
    }

    public function delete(User $user, Subject $subject)
    {
        return $user->role->name === 'admin';
    }
}
