<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class VideoPolicy
{
    use HandlesAuthorization;

    /** Determine whether the user can create tips */
    public function create(User $user) : bool
    {
        return $user->is_admin;
    }

    /** Determine whether the user can edit tips */
    public function edit(User $user) : bool
    {
        return $user->is_admin;
    }

    /** Determine whether the user can store tips */
    public function store(User $user) : bool
    {
        return $user->is_admin;
    }

    /** Determine whether the user can update the tip */
    public function update(User $user) : bool
    {
        return $user->is_admin;
    }

    /** Determine whether the user can delete the tip */
    public function delete(User $user) : bool
    {
        return $user->is_admin;
    }
}
