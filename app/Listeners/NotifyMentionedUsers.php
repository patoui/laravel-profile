<?php

namespace App\Listeners;

use App\User;
use App\Events\CommentSaved;
use App\Notifications\UserMentioned;

class NotifyMentionedUsers
{
    public function handle(CommentSaved $event) : void
    {
        User::whereIn('name', $event->comment->mentionedUsers())
            ->get()
            ->each(function ($user) use ($event) {
                $user->notify(new UserMentioned($event->comment));
            });
    }
}
