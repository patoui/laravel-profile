<?php

declare(strict_types=1);

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProfilePolicy
{
    use HandlesAuthorization;

    public function show(User $auth, User $user) : bool
    {
        return $user->id === $auth->id;
    }
}
