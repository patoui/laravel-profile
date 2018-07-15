<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProfilePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view a profile.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function show(User $auth, User $user)
    {
        return $user->id === auth()->id();
    }
}
