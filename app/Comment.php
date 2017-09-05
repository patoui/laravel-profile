<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['comment_id', 'body'];

    /**
     * Comments on a comment
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Short human friendly timestamp
     *
     * @return string
     */
    public function getShortTimestampAttribute()
    {
        $local = $this->created_at->setTimezone('America/Toronto');

        if ($local->isToday()) {
            return $local->diffForHumans();
        }

        return $local->format('F jS g:i A');
    }
}
