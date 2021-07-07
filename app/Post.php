<?php

declare(strict_types=1);

namespace App;

use Database\Factories\PostFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Carbon;
use Spatie\Feed\Feedable;
use Spatie\Feed\FeedItem;
use Spatie\Tags\HasTags;

/**
 * Class Post
 * @package App
 * @property int    $id
 * @property string $title
 * @property string $slug
 * @property string $body
 * @property null|Carbon $published_at
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property-read string $short_body
 *
 * @method static PostFactory factory(...$parameters)
 */
class Post extends Model implements Feedable
{
    use HasTags;
    use Publishes;
    use RecordsActivity;
    use HasFactory;

    /** @var array<string> */
    protected $guarded = [];

    /** @var array<string> */
    protected $appends = ['favourites_count'];

    /** @var array<string> */
    protected $casts = ['published_at' => 'datetime'];

    public function analytics(): MorphMany
    {
        return $this->morphMany(Analytic::class, 'analytical');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class)->whereNull('comment_id');
    }

    /** @param array<mixed> $data */
    public function createComment(array $data): Model
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

    public function scopeSlug(Builder $builder, string $slug): Builder
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
                    (string) preg_replace("/(\r?\n){2,}/", ' ', strip_tags($this->body))
                )
            ),
            0,
            100
        );
    }

    public function getPathAttribute(): string
    {
        return route('post.show', ['post_slug' => $this->slug]);
    }

    public function toFeedItem(): FeedItem
    {
        return FeedItem::create()
            ->id((string) $this->id)
            ->title($this->title)
            ->summary($this->short_body)
            ->updated($this->updated_at)
            ->link(route('post.show', ['post' => $this->slug]))
            ->author('Patrique Ouimet');
    }

    public static function getFeedItems(): Collection
    {
        return self::published()->latest()->get();
    }

    public static function findBySlug(string $slug): ?self
    {
        return self::where('slug', $slug)->first();
    }
}
