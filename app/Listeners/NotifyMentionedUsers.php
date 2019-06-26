<?php

declare(strict_types=1);

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
            ->each(static function ($user) use ($event) : void {
                $user->notify(new UserMentioned($event->comment));
            });
    }
}
