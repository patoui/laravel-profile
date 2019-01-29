<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use RecordsActivity;

    /**
     * List of guarded model properties
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Properties that can be filled
     *
     * @var array
     */
    protected $fillable = ['title', 'body', 'slug'];

    /**
     * Mutated properties to append
     *
     * @var array
     */
    protected $appends = ['favourites_count'];

    /**
     * List of model properties to be casted
     *
     * @var array
     */
    protected $casts = ['published_at' => 'datetime'];

    /**
     * Post analytics relationship
     */
    public function analytics()
    {
        return $this->hasMany(PostAnalytics::class);
    }

    /**
     * Comments relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class)
            ->whereNull('comment_id');
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
     * Favourites relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function favourites()
    {
        return $this->morphMany(Favourite::class, 'favouritable');
    }

    /**
     * Favourites count
     *
     * @return integer
     */
    public function getFavouritesCountAttribute()
    {
        return $this->favourites()->count();
    }

    /**
     * Scoped by slug
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $slug
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSlug($query, $slug)
    {
        return $query->where('slug', $slug);
    }

    /**
     * Parse github markdown to html
     *
     * @return string
     */
    public function getParsedBodyAttribute()
    {
        return (new \Parsedown())->text($this->body);
    }

    /**
     * First 100 characters of the post body
     *
     * @return string
     */
    public function getShortBodyAttribute()
    {
        return substr( // get first 100 characters
            trim( // remove trailing whitespace
                preg_replace(
                    '/[^\da-z ]/i', // remove all non alphanumeric
                    '',
                    preg_replace("/(\r?\n){2,}/", ' ', strip_tags($this->body)) // convert newline characters to a space
                )
            ), 0, 100);
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
                ->toDayDateTimeString()
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

    /**
     * Get the previous published post
     *
     * @return null|App\Post
     */
    public function previousPublished()
    {
        return $this->newQuery()
            ->where('id', '<>', $this->id)
            ->where('published_at', '<', $this->published_at)
            ->published()
            ->latest()
            ->first();
    }

    /**
     * Get the next published post
     *
     * @return null|App\Post
     */
    public function nextPublished()
    {
        return $this->newQuery()
            ->where('id', '<>', $this->id)
            ->where('published_at', '>', $this->published_at)
            ->published()
            ->latest()
            ->first();
    }

    public function getPathAttribute()
    {
        return route('post.show', ['slug' => $this->slug]);
    }
}
