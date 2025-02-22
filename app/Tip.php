<?php

declare(strict_types=1);

namespace App;

use Database\Factories\TipFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Carbon;
use Spatie\Tags\HasTags;

/**
 * Class Tip
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $body
 * @property null|Carbon $published_at
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @method static TipFactory factory(...$parameters)
 */
final class Tip extends Model
{
    use HasFactory;
    use HasTags;
    use Publishes;

    /** @var list<string> */
    protected $guarded = [];

    /** @var array<string, string> */
    protected $casts = ['published_at' => 'datetime'];

    public static function findBySlug(string $slug): ?self
    {
        return self::where('slug', $slug)->first();
    }

    public function analytics(): MorphMany
    {
        return $this->morphMany(Analytic::class, 'analytical');
    }

    public function scopeSlug(Builder $query, string $slug): Builder
    {
        return $query->where('slug', $slug);
    }

    public function getShortTitleAttribute(): string
    {
        return substr($this->title, 0, 100);
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
        return route('tip.show', ['tip' => $this->slug]);
    }
}
