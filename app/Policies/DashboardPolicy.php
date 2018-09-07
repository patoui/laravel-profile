<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DashboardPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can publish posts.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function index(User $user)
    {
        return $user->is_admin;
    }
}
