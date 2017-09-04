<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPublishPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can publish posts.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function publish(User $user)
    {
        return $user->isAdmin();
    }
}
