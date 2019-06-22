<?php

namespace App\Policies;

use App\Post;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /** Determine whether the user can create posts */
    public function create(User $user) : bool
    {
        return $user->is_admin;
    }

    /** Determine whether the user can edit posts. */
    public function edit(User $user) : bool
    {
        return $user->is_admin;
    }

    /** Determine whether the user can store posts */
    public function store(User $user) : bool
    {
        return $user->is_admin;
    }

    /** Determine whether the user can update the post */
    public function update(User $user) : bool
    {
        return $user->is_admin;
    }

    /** Determine whether the user can delete the post */
    public function delete(User $user) : bool
    {
        return $user->is_admin;
    }
}
