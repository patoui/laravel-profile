<?php

declare(strict_types=1);

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MediaPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the media library.
     *
     * @return mixed
     */
    public function index(User $user)
    {
        return $user->is_admin;
    }

    /**
     * Determine whether the user can view the add media page.
     *
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->is_admin;
    }

    /**
     * Determine whether the user can view the edit media page.
     *
     * @return mixed
     */
    public function edit(User $user)
    {
        return $user->is_admin;
    }

    /**
     * Determine whether the user can add media to the media library.
     *
     * @return mixed
     */
    public function store(User $user)
    {
        return $user->is_admin;
    }

    /**
     * Determine whether the user can update media.
     *
     * @return mixed
     */
    public function update(User $user)
    {
        return $user->is_admin;
    }

    /**
     * Determine whether the user can delete media to from media library.
     *
     * @return mixed
     */
    public function delete(User $user)
    {
        return $user->is_admin;
    }
}
