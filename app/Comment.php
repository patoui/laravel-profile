<?php

namespace App;

use App\Events\CommentSaved;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use RecordsActivity;

    /**
     * Guarded properties.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Mutated properties to append.
     *
     * @var array
     */
    protected $appends = ['favourites_count'];

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = ['saved' => CommentSaved::class];

    /**
     * Owner of the comment.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Comments on a comment.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    /**
     * Short human friendly timestamp.
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
        return $this->post->path.'#comment'.$this->id;
    }

    /**
     * Favourites relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function favourites()
    {
        return $this->morphMany(Favourite::class, 'favouritable');
    }

    /**
     * Favourites count.
     *
     * @return int
     */
    public function getFavouritesCountAttribute()
    {
        return $this->favourites()->count();
    }

    /**
     * Get all mentioned users within the comment body.
     *
     * @return array
     */
    public function mentionedUsers()
    {
        preg_match_all('/@([\w\-]+)/', $this->body, $matches);

        return $matches[1];
    }
}
