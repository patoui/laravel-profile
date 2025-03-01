<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Repositories\Traits\PublishesRepository;
use App\Tip;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

final class TipRepository
{
    use PublishesRepository;

    public function create(
        string $title,
        string $body,
        string $slug,
        array $tags = [],
    ) {
        $tip = new Tip;

        $tip->title = $title;
        $tip->body = $body;
        $tip->slug = $slug;

        DB::transaction(function () use ($tip, $tags) {
            $tip->save();
            $tip->syncTags($tags);
        });

        return $tip;
    }

    public function update(
        Tip $tip,
        string $title,
        string $body,
        string $slug,
        array $tags = [],
    ) {
        $tip->title = $title;
        $tip->body = $body;
        $tip->slug = $slug;

        DB::transaction(function () use ($tip, $tags) {
            $tip->save();
            $tip->syncTags($tags);
        });

        return $tip;
    }

    public function latestPublished(?array $tags = null): Collection
    {
        return Tip::query()
            ->published()
            ->latest()
            ->when($tags, fn (Builder $query) => $query->withAnyTags($tags))
            ->get();
    }

    public function previousPublished(Tip $tip): ?Tip
    {
        /** @var Tip|null $tip */
        $tip = Tip::query()
            ->previousPublished($tip)
            ->first();

        return $tip;
    }

    public function nextPublished(Tip $tip): ?Tip
    {
        /** @var Tip|null $tip */
        $tip = Tip::query()
            ->nextPublished($tip)
            ->first();

        return $tip;
    }
}
