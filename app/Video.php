<?php

declare(strict_types=1);

namespace App;

use Database\Factories\VideoFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Carbon;
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
class Video extends Model
{
    use HasFactory;
    use HasTags;
    use Publishes;

    /** @var array<string> */
    protected $guarded = [];

    /** @var array<string, string> */
    protected $casts = ['published_at' => 'datetime'];

    public function analytics(): MorphMany
    {
        return $this->morphMany(Analytic::class, 'analytical');
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function getEmbedUrlAttribute(): ?string
    {
        return sprintf(
            'https://www.youtube.com/embed/%s?rel=0&amp;showinfo=0',
            $this->external_id
        );
    }
}
