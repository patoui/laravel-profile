<?php

declare(strict_types=1);

namespace App;

use Illuminate\Support\Carbon;

trait Publishes
{
    /**
     * @param  mixed  $query
     * @return mixed
     */
    public function scopePublished($query)
    {
        return $query->whereNotNull('published_at');
    }

    public function previousPublished(): ?self
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

    public function nextPublished(): ?self
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

    public function togglePublish(): void
    {
        $this->published_at = $this->published_at ? null : Carbon::now();
        $this->save();
    }

    public function getShortPublishedAtAttribute(): ?string
    {
        return $this->published_at
            ? $this->published_at
                ->setTimezone('America/Toronto')
                ->toDayDateTimeString()
            : null;
    }
}
