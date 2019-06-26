<?php

declare(strict_types=1);

namespace App\Listeners;

use function me;
use App\Events\CommentSaved;
use App\Notifications\UserCommented;

class NotifyMe
{
    /**
     * Handle the event.
     */
    public function handle(CommentSaved $event) : void
    {
        // Notify me when someone comments
        me()->notify(new UserCommented($event->comment));
    }
}
