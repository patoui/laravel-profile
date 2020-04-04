<?php

declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Spatie\Tags\HasTags;

class Tip extends Model
{
    use HasTags, Publishes, RecordsActivity;

    /** @var array<string> */
    protected $guarded = [];

    /** @var array<string> */
    protected $casts = ['published_at' => 'datetime'];

    public function analytics() : HasMany
    {
        return $this->hasMany(TipAnalytics::class);
    }

    public function favourites() : MorphMany
    {
        return $this->morphMany(Favourite::class, 'favouritable');
    }

    public function getFavouritesCountAttribute() : int
    {
        return $this->favourites()->count();
    }

    public function scopeSlug(Builder $query, string $slug) : Builder
    {
        return $query->where('slug', $slug);
    }

    public function getShortTitleAttribute() : string
    {
        return substr($this->title, 0, 100);
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
        return route('tip.show', ['tip' => $this->slug]);
    }

    public static function findBySlug(string $slug): ?self
    {
        return self::where('slug', $slug)->first();
    }
}
