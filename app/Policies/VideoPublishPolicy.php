<?php

declare(strict_types=1);

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

final class VideoPublishPolicy
{
    use HandlesAuthorization;

    public function publish(User $user): bool
    {
        return (bool) $user->is_admin;
    }
}
