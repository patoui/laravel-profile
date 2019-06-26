<?php

declare(strict_types=1);

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Spatie\Feed\Feedable;
use Spatie\Feed\FeedItem;
use function preg_replace;
use function route;
use function strip_tags;
use function substr;
use function trim;

class Post extends Model implements Feedable
{
    use RecordsActivity;

    /** @var array<string> */
    protected $guarded = [];

    /** @var array<string> */
    protected $appends = ['favourites_count'];

    /** @var array<string> */
    protected $casts = ['published_at' => 'datetime'];

    public function analytics() : HasMany
    {
        return $this->hasMany(PostAnalytics::class);
    }

    public function comments() : HasMany
    {
        return $this->hasMany(Comment::class)->whereNull('comment_id');
    }

    /** @param array<mixed> $data */
    public function createComment(array $data) : Model
    {
        return $this->comments()->create($data);
    }

    public function favourites() : MorphMany
    {
        return $this->morphMany(Favourite::class, 'favouritable');
    }

    public function getFavouritesCountAttribute() : int
    {
        return $this->favourites()->count();
    }

    public function scopeSlug(Builder $builder, string $slug) : Builder
    {
        return $builder->where('slug', $slug);
    }

    public function getShortTitleAttribute() : string
    {
        return substr($this->title, 0, 50);
    }

    public function getShortBodyAttribute() : string
    {
        return substr( // get first 100 characters
            trim( // remove trailing whitespace
                (string) preg_replace(
                    '/[^\da-z ]/i', // remove all non alphanumeric
                    '',
                    (string) preg_replace("/(\r?\n){2,}/", ' ', strip_tags($this->body))
                )
            ),
            0,
            100
        );
    }

    public function getShortPublishedAtAttribute() : ?string
    {
        return $this->published_at
            ? $this->published_at
                ->setTimezone('America/Toronto')
                ->toFormattedDateString()
            : null;
    }

    public function togglePublish() : void
    {
        $this->published_at       = $this->published_at
            ? $this->published_at = null
            : Carbon::now();

        $this->save();
    }

    public function scopePublished(Builder $builder) : Builder
    {
        return $builder->whereNotNull('published_at');
    }

    /** @return mixed */
    public function previousPublished()
    {
        return (new self())
            ->where('id', '<>', $this->id)
            ->where('published_at', '<', $this->published_at)
            ->published()
            ->latest()
            ->first();
    }

    /** @return mixed */
    public function nextPublished()
    {
        return (new self())
            ->where('id', '<>', $this->id)
            ->where('published_at', '>', $this->published_at)
            ->whereNotNull('published_at')
            ->latest()
            ->first();
    }

    public function getPathAttribute() : string
    {
        return route('post.show', ['slug' => $this->slug]);
    }

    public function toFeedItem() : FeedItem
    {
        return FeedItem::create()
            ->id($this->id)
            ->title($this->title)
            ->summary($this->short_body)
            ->updated($this->updated_at)
            ->link(route('post.show', ['slug' => $this->slug]))
            ->author('Patrique Ouimet');
    }

    /** @return array<mixed> */
    public static function getFeedItems() : array
    {
        return self::published()->latest()->get()->all();
    }
}
