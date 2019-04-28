<?php

namespace App;

use App\Events\CommentSaved;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use RecordsActivity;

    protected $guarded = [];

    protected $appends = ['favourites_count'];

    protected $dispatchesEvents = ['saved' => CommentSaved::class];

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function getShortCreatedAtAttribute()
    {
        return $this->created_at
            ? $this->created_at
                ->setTimezone('America/Toronto')
                ->toFormattedDateString()
            : null;
    }

    public function getPathAttribute()
    {
        return $this->post->path.'#comment'.$this->id;
    }

    public function favourites()
    {
        return $this->morphMany(Favourite::class, 'favouritable');
    }

    public function getFavouritesCountAttribute()
    {
        return $this->favourites()->count();
    }

    public function mentionedUsers()
    {
        preg_match_all('/@([\w\-]+)/', $this->body, $matches);

        return $matches[1];
    }
}
