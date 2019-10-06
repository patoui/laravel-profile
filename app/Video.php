<?php

declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Video extends Model
{
    /** @var array<string> */
    protected $guarded = [];

    /** @var array<string> */
    protected $casts = ['published_at' => 'datetime'];

    public function getRouteKeyName() : string
    {
        return 'slug';
    }

    /**
     * @param mixed $query
     *
     * @return mixed
     */
    public function scopePublished($query)
    {
        return $query->whereNotNull('published_at');
    }

    public function previousPublished() : ?self
    {
        return (new self())
            ->where('id', '<>', $this->id)
            ->when($this->published_at, function ($q) {
                return $q->where('published_at', '<', $this->published_at);
            })
            ->published()
            ->latest()
            ->first();
    }

    public function nextPublished() : ?self
    {
        return (new self())
            ->where('id', '<>', $this->id)
            ->when($this->published_at, function ($q) {
                return $q->where('published_at', '>', $this->published_at);
            })
            ->published()
            ->latest()
            ->first();
    }

    public function getShortPublishedAtAttribute() : ?string
    {
        return $this->published_at
            ? $this->published_at
                ->setTimezone('America/Toronto')
                ->toDayDateTimeString()
            : null;
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
