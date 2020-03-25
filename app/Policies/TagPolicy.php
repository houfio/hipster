<?php

namespace App\Policies;

use App\Tag;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TagPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->isManager();
    }

    public function view(User $user, Tag $tag)
    {
        return $user->isManager();
    }

    public function create(User $user)
    {
        return $user->isManager();
    }

    public function update(User $user, Tag $tag)
    {
        return $user->isManager();
    }

    public function delete(User $user, Tag $tag)
    {
        return $user->isManager();
    }
}
