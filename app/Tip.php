<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Tip extends Model
{
    use RecordsActivity;

    protected $guarded = [];

    protected $casts = ['published_at' => 'datetime'];

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function addTags(array $tags)
    {
        $ids = [];

        foreach ($tags as $key => $tag) {
            $ids[] = Tag::firstOrCreate(['name' => strtolower($tag)])->id;
        }

        $this->tags()->sync($ids);

        return $this->tags;
    }

    public function analytics()
    {
        return $this->hasMany(TipAnalytics::class);
    }

    public function favourites()
    {
        return $this->morphMany(Favourite::class, 'favouritable');
    }

    public function getFavouritesCountAttribute()
    {
        return $this->favourites()->count();
    }

    public function scopeSlug($query, $slug)
    {
        return $query->where('slug', $slug);
    }

    public function getShortTitleAttribute()
    {
        return substr($this->title, 0, 100);
    }

    public function getShortBodyAttribute()
    {
        return substr( // get first 100 characters
            trim( // remove trailing whitespace
                preg_replace(
                    '/[^\da-z ]/i', // remove all non alphanumeric
                    '',
                    preg_replace("/(\r?\n){2,}/", ' ', strip_tags($this->body)) // convert newline characters to a space
                )
            ), 0, 100);
    }

    public function getShortPublishedAtAttribute()
    {
        return $this->published_at
            ? $this->published_at
                ->setTimezone('America/Toronto')
                ->toDayDateTimeString()
            : null;
    }

    public function togglePublish()
    {
        $this->published_at = $this->published_at
            ? $this->published_at = null
            : Carbon::now();

        $this->save();
    }

    public function scopePublished($query)
    {
        return $query->whereNotNull('published_at');
    }

    public function previousPublished()
    {
        return $this->newQuery()
            ->where('id', '<>', $this->id)
            ->when($this->published_at, function ($q) {
                return $q->where('published_at', '<', $this->published_at);
            })
            ->published()
            ->latest()
            ->first();
    }

    public function nextPublished()
    {
        return $this->newQuery()
            ->where('id', '<>', $this->id)
            ->when($this->published_at, function ($q) {
                return $q->where('published_at', '>', $this->published_at);
            })
            ->published()
            ->latest()
            ->first();
    }

    public function getPathAttribute()
    {
        return route('tip.show', ['slug' => $this->slug]);
    }
}
