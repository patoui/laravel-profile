<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'body', 'url'];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function getShortBodyAttribute()
    {
        return substr($this->body, 0, 100);
    }

    public function getShortPublishedAtAttribute()
    {
        return $this->published_at
            ? $this->published_at
            ->setTimezone('America/Toronto')
            ->format('F jS g:i A')
            : null;
    }

    public function togglePublish()
    {
        $this->published_at = $this->published_at
            ? $this->published_at = null
            : Carbon::now();

        $this->save();
    }
}
