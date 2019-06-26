<?php

declare(strict_types=1);

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TipPublishPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can publish tips.
     *
     * @return mixed
     */
    public function publish(User $user)
    {
        return $user->is_admin;
    }
}
