<?php

declare(strict_types=1);

namespace App;

use Database\Factories\PostFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Spatie\Feed\Feedable;
use Spatie\Feed\FeedItem;
use Spatie\Tags\HasTags;

/**
 * Class Post
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $body
 * @property null|Carbon $published_at
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read string $short_body
 *
 * @method static PostFactory factory(...$parameters)
 */
final class Post extends Model implements Feedable
{
    use HasFactory;
    use HasTags;
    use Publishes;

    /** @var list<string> */
    protected $guarded = [];

    public static function getFeedItems(): Collection
    {
        return self::published()->latest()->get();
    }

    public static function findBySlug(string $slug): ?self
    {
        return self::where('slug', $slug)->first();
    }

    public function analytics(): MorphMany
    {
        return $this->morphMany(Analytic::class, 'analytical');
    }

    public function scopeSlug(Builder $builder, string $slug): Builder
    {
        return $builder->where('slug', $slug);
    }

    public function toFeedItem(): FeedItem
    {
        return FeedItem::create()
            ->id((string) $this->id)
            ->title($this->title)
            ->summary($this->short_body)
            ->updated($this->updated_at)
            ->link(route('post.show', ['post' => $this]))
            ->authorName('Patrique Ouimet')
            ->authorEmail('patrique.ouimet@gmail.com');
    }

    protected function shortTitle(): Attribute
    {
        return Attribute::make(get: function () {
            return substr($this->title, 0, 50);
        });
    }

    protected function shortBody(): Attribute
    {
        return Attribute::make(get: fn () => Str::short($this->body));
    }

    protected function path(): Attribute
    {
        return Attribute::make(get: function () {
            return route('post.show', ['post' => $this]);
        });
    }

    /**
     * @return array<string, string> */
    protected function casts(): array
    {
        return ['published_at' => 'datetime'];
    }
}
