<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class VideoPublishPolicy
{
    use HandlesAuthorization;

    public function publish(User $user)
    {
        return $user->is_admin;
    }
}
