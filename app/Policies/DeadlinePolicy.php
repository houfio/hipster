<?php

namespace App\Policies;

use App\Exam;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DeadlinePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->isManager();
    }

    public function view(User $user, Exam $exam)
    {
        return $user->isManager();
    }

    public function create(User $user)
    {
        return $user->isManager();
    }

    public function update(User $user, Exam $exam)
    {
        return $user->isManager();
    }

    public function delete(User $user, Exam $exam)
    {
        return $user->isManager();
    }
}
