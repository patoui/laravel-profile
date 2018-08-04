<?php

namespace App;

use App\Favourite;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use RecordsActivity;

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
     * Comments on a comment
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
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

    public function getPathAttribute()
    {
        return $this->post->path . '#comment' . $this->id;
    }

    public function favourites()
    {
        return $this->morphMany(Favourite::class, 'favouritable');
    }
}
