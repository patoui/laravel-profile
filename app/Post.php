<?php

declare(strict_types=1);

namespace App;

use App\Builders\PostBuilder;
use App\Interfaces\CanPublish;
use App\Traits\Publishes;
use Carbon\CarbonInterface;
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
 * @property null|CarbonInterface $published_at
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read string $short_body
 *
 * @method static PostBuilder&Builder query()
 * @method static PostFactory factory(...$parameters)
 */
final class Post extends Model implements CanPublish, Feedable
{
    use HasFactory;
    use HasTags;
    use Publishes;

    /** @var list<string> */
    protected $guarded = [];

    public static function getFeedItems(): Collection
    {
        return self::query()->published()->latest()->get();
    }

    public function newEloquentBuilder($query): PostBuilder
    {
        return new PostBuilder($query);
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

    public function shortPublishedAt(): Attribute
    {
        return Attribute::make(
            get: function () {
                if (! $this->published_at) {
                    return null;
                }

                return $this->published_at
                    ->setTimezone('America/Toronto')
                    ->toDayDateTimeString();
            }
        );
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
