<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProfilePolicy
{
    use HandlesAuthorization;

    public function show(User $auth, User $user)
    {
        return $user->id === $auth->id;
    }
}
