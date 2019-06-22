<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Spatie\Feed\Feedable;
use Spatie\Feed\FeedItem;
use Illuminate\Database\Eloquent\Model;

class Post extends Model implements Feedable
{
    use RecordsActivity;

    protected $guarded = [];

    protected $appends = ['favourites_count'];

    protected $casts = ['published_at' => 'datetime'];

    public function analytics(): HasMany
    {
        return $this->hasMany(PostAnalytics::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class)->whereNull('comment_id');
    }

    public function createComment($data)
    {
        return $this->comments()->create($data);
    }

    public function favourites(): MorphMany
    {
        return $this->morphMany(Favourite::class, 'favouritable');
    }

    public function getFavouritesCountAttribute(): int
    {
        return $this->favourites()->count();
    }

    public function scopeSlug(Builder $builder, string $slug)
    {
        return $builder->where('slug', $slug);
    }

    public function getShortTitleAttribute(): string
    {
        return substr($this->title, 0, 50);
    }

    public function getShortBodyAttribute(): string
    {
        return substr( // get first 100 characters
            trim( // remove trailing whitespace
                (string) preg_replace(
                    '/[^\da-z ]/i', // remove all non alphanumeric
                    '',
                    (string) preg_replace("/(\r?\n){2,}/", ' ', strip_tags($this->body)) // convert newline characters to a space
                )
            ), 0, 100);
    }

    public function getShortPublishedAtAttribute(): ?string
    {
        return $this->published_at
            ? $this->published_at
                ->setTimezone('America/Toronto')
                ->toFormattedDateString()
            : null;
    }

    public function togglePublish(): void
    {
        $this->published_at = $this->published_at
            ? $this->published_at = null
            : Carbon::now();

        $this->save();
    }

    public function scopePublished(Builder $builder)
    {
        return $builder->whereNotNull('published_at');
    }

    /** @return mixed */
    public function previousPublished()
    {
        return (new self)
            ->where('id', '<>', $this->id)
            ->where('published_at', '<', $this->published_at)
            ->published()
            ->latest()
            ->first();
    }

    /** @return mixed */
    public function nextPublished()
    {
        return (new self)
            ->where('id', '<>', $this->id)
            ->where('published_at', '>', $this->published_at)
            ->whereNotNull('published_at')
            ->latest()
            ->first();
    }

    public function getPathAttribute(): string
    {
        return route('post.show', ['slug' => $this->slug]);
    }

    public function toFeedItem(): FeedItem
    {
        return FeedItem::create()
            ->id($this->id)
            ->title($this->title)
            ->summary($this->short_body)
            ->updated($this->updated_at)
            ->link(route('post.show', ['slug' => $this->slug]))
            ->author('Patrique Ouimet');
    }

    public static function getFeedItems(): array
    {
        return self::published()->latest()->get()->all();
    }
}
