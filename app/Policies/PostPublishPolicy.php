<?php

declare(strict_types=1);

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPublishPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can publish posts.
     *
     * @return mixed
     */
    public function publish(User $user)
    {
        return $user->is_admin;
    }
}
