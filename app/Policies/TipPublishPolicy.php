<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TipPublishPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can publish tips.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function publish(User $user)
    {
        return $user->is_admin;
    }
}
