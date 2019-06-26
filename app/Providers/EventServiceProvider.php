<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /** @var mixed[] */
    protected $listen = [
        'App\Events\CommentSaved' => [
            'App\Listeners\NotifyMe',
            'App\Listeners\NotifyMentionedUsers',
        ],
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];
}
