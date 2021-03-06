<?php

declare(strict_types=1);

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SmsPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view sms index.
     *
     * @param User $user
     * @return mixed
     */
    public function index(User $user)
    {
        return $user->is_admin;
    }

    /**
     * Determine whether the user can store posts.
     *
     * @param User $user
     * @return mixed
     */
    public function store(User $user)
    {
        return $user->is_admin;
    }
}
