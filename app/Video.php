<?php

declare(strict_types=1);

namespace App;

use Database\Factories\VideoFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Carbon;
use Spatie\Feed\Feedable;
use Spatie\Feed\FeedItem;
use Spatie\Tags\HasTags;

/**
 * Class Video
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $description
 * @property null|Carbon $published_at
 * @property string $external_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @method static VideoFactory factory(...$parameters)
 */
final class Video extends Model implements Feedable
{
    use HasFactory;
    use HasTags;
    use Publishes;

    /** @var array<string> */
    protected $guarded = [];

    public static function getFeedItems(): Collection
    {
        return self::published()->latest()->get();
    }

    public function analytics(): MorphMany
    {
        return $this->morphMany(Analytic::class, 'analytical');
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function toFeedItem(): FeedItem
    {
        return FeedItem::create()
            ->id((string) $this->id)
            ->title($this->title)
            ->summary($this->description ?: 'Tech video')
            ->updated($this->updated_at)
            ->link(route('video.show', [$this]))
            ->authorName('Patrique Ouimet')
            ->authorEmail('patrique.ouimet@gmail.com');
    }

    protected function embedUrl(): Attribute
    {
        return Attribute::make(get: function () {
            return sprintf(
                'https://www.youtube.com/embed/%s?rel=0&amp;showinfo=0',
                $this->external_id
            );
        });
    }

    /**
     * @return array<string, string> */
    protected function casts(): array
    {
        return ['published_at' => 'datetime'];
    }
}
