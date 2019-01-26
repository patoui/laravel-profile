<?php

namespace App\Policies;

use App\User;
use App\Tip;
use Illuminate\Auth\Access\HandlesAuthorization;

class TipPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can create tips.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->is_admin;
    }

    /**
     * Determine whether the user can edit tips.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function edit(User $user)
    {
        return $user->is_admin;
    }

    /**
     * Determine whether the user can store tips.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function store(User $user)
    {
        return $user->is_admin;
    }

    /**
     * Determine whether the user can update the tip.
     *
     * @param  \App\User  $user
     * @param  \App\Tip  $tip
     * @return mixed
     */
    public function update(User $user)
    {
        return $user->is_admin;
    }

    /**
     * Determine whether the user can delete the tip.
     *
     * @param  \App\User  $user
     * @param  \App\Tip  $tip
     * @return mixed
     */
    public function delete(User $user)
    {
        return $user->is_admin;
    }
}
