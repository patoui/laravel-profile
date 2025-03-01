<?php

declare(strict_types=1);

namespace App\Builders\Traits;

use App\Builders\PostBuilder;
use App\Builders\TipBuilder;
use App\Builders\VideoBuilder;
use App\Interfaces\CanPublish;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

trait Publishes
{
    public function published(): self
    {
        return $this->whereNotNull('published_at');
    }

    public function previousPublished(CanPublish&Model $publishable): self
    {
        // TODO: fix me
        /** @var PostBuilder|TipBuilder|VideoBuilder $query */
        $query = $publishable->newQuery();

        return $query
            ->where('id', '<>', $publishable->getKey())
            ->when(
                $publishable->getPublishedAt(),
                fn (Builder $query) => $query->where('published_at', '<', $publishable->getPublishedAt()),
            )
            ->published()
            ->latest();
    }

    public function nextPublished(CanPublish&Model $publishable): self
    {
        // TODO: fix me
        /** @var PostBuilder|TipBuilder|VideoBuilder $query */
        $query = $publishable->newQuery();

        return $query
            ->where('id', '<>', $publishable->getKey())
            ->when(
                $publishable->getPublishedAt(),
                fn ($q) => $q->where('published_at', '>', $publishable->getPublishedAt()),
            )
            ->published()
            ->latest();
    }
}
