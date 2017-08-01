<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['body'];

    public function getShortTimestampAttribute()
    {
        $local = $this->created_at->setTimezone('America/Toronto');

        if ($local->isToday()) {
            return $local->diffForHumans();
        }

        return $local->format('F jS g:i A');
    }
}
