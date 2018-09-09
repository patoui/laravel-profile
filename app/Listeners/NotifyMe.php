<?php

namespace App\Listeners;

use App\Events\CommentSaved;
use App\Notifications\UserCommented;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyMe
{
    /**
     * Handle the event.
     *
     * @param  CommentSaved  $event
     * @return void
     */
    public function handle(CommentSaved $event)
    {
        // Notify me when someone comments
        me()->notify(new UserCommented($event->comment));
    }
}
