<?php

declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Carbon;
use Spatie\Feed\Feedable;
use Spatie\Feed\FeedItem;
use Spatie\Tags\HasTags;
use function preg_replace;
use function route;
use function strip_tags;
use function substr;
use function trim;

/**
 * Class Post
 * @package App
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $body
 * @property Carbon $published_at
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Post extends Model implements Feedable
{
    use HasTags, Publishes, RecordsActivity;

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

    public function getPathAttribute() : string
    {
        return route('post.show', ['post' => $this->slug]);
    }

    public function toFeedItem() : FeedItem
    {
        return FeedItem::create()
            ->id($this->id)
            ->title($this->title)
            ->summary($this->short_body)
            ->updated($this->updated_at)
            ->link(route('post.show', ['post' => $this->slug]))
            ->author('Patrique Ouimet');
    }

    /** @return array<mixed> */
    public static function getFeedItems() : array
    {
        return self::published()->latest()->get()->all();
    }

    public static function findBySlug(string $slug): ?self
    {
        return self::where('slug', $slug)->first();
    }
}
