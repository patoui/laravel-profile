<?php

declare(strict_types=1);

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

final class PostPolicy
{
    use HandlesAuthorization;

    /** Determine whether the user can create posts */
    public function create(User $user): bool
    {
        return $user->is_admin;
    }

    /** Determine whether the user can edit posts. */
    public function edit(User $user): bool
    {
        return $user->is_admin;
    }

    /** Determine whether the user can store posts */
    public function store(User $user): bool
    {
        return $user->is_admin;
    }

    /** Determine whether the user can update the post */
    public function update(User $user): bool
    {
        return $user->is_admin;
    }

    /** Determine whether the user can delete the post */
    public function delete(User $user): bool
    {
        return $user->is_admin;
    }
}
