<?php

declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Spatie\Tags\HasTags;

class Video extends Model
{
    use HasTags, Publishes, RecordsActivity;

    /** @var array<string> */
    protected $guarded = [];

    /** @var array<string> */
    protected $casts = ['published_at' => 'datetime'];

    public function analytics() : HasMany
    {
        return $this->hasMany(VideoAnalytics::class);
    }

    public function getRouteKeyName() : string
    {
        return 'slug';
    }

    public function getEmbedUrlAttribute() : ?string
    {
        return sprintf(
            'https://www.youtube.com/embed/%s?rel=0&amp;showinfo=0',
            $this->external_id
        );
    }

    public function favourites() : MorphMany
    {
        return $this->morphMany(Favourite::class, 'favouritable');
    }

    public function getFavouritesCountAttribute() : int
    {
        return $this->favourites()->count();
    }
}
