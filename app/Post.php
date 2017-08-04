<?php

namespace App;

use App\Comment;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Post extends Model
{
    /**
     * Properties that can be filled
     *
     * @var array
     */
    protected $fillable = ['title', 'body', 'slug'];

    /**
     * List of model properties to be casted
     *
     * @var array
     */
    protected $casts = [
        'published_at' => 'datetime',
    ];

    /**
     * Comments relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Create comment from array of data
     *
     * @param  array $data array of data
     * @return App\Comment
     */
    public function createComment($data)
    {
        return $this->comments()->create($data);
    }

    /**
     * Find a post by its slug or throw a model not found exception.
     *
     * @param  mixed  $slug
     * @param  array  $columns
     * @return App\Post
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public static function findOrFailBySlug($slug, $columns = ['*'])
    {
        return (new static)->where('slug', $slug)->firstOrFail($columns);
    }

    /**
     * First 100 characters of the post body
     *
     * @return string
     */
    public function getShortBodyAttribute()
    {
        return substr(strip_tags($this->body), 0, 100);
    }

    /**
     * Short human friendly published date
     *
     * @return string|null
     */
    public function getShortPublishedAtAttribute()
    {
        return $this->published_at
            ? $this->published_at
                ->setTimezone('America/Toronto')
                ->format('F jS g:i A')
            : null;
    }

    /**
     * Toggle published status
     *
     * @return void
     */
    public function togglePublish()
    {
        $this->published_at = $this->published_at
            ? $this->published_at = null
            : Carbon::now();

        $this->save();
    }

    /**
     * Query scope to get published posts
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePublished($query)
    {
        return $query->whereNotNull('published_at');
    }
}
