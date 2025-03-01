<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Repositories\Traits\PublishesRepository;
use App\Video;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

final class VideoRepository
{
    use PublishesRepository;

    public function create(
        string $title,
        string $slug,
        string $externalId,
        array $tags = [],
    ) {
        $video = new Video();

        $video->title = $title;
        $video->external_id = $externalId;
        $video->slug = $slug;

        DB::transaction(function () use ($video, $tags) {
            $video->save();
            $video->syncTags($tags);
        });

        return $video;
    }

    public function update(
        Video $video,
        string $title,
        string $slug,
        string $externalId,
        array $tags = [],
    ) {
        $video->title = $title;
        $video->slug = $slug;
        $video->external_id = $externalId;

        DB::transaction(function () use ($video, $tags) {
            $video->save();
            $video->syncTags($tags);
        });

        return $video;
    }

    public function latestPublished(?array $tags = null): Collection
    {
        return Video::query()
            ->published()
            ->latest()
            ->when($tags, fn (Builder $query) => $query->withAnyTags($tags))
            ->get();
    }

    public function previousPublished(Video $video): ?Video
    {
        /** @var Video|null $video */
        $video = Video::query()
            ->previousPublished($video)
            ->first();

        return $video;
    }

    public function nextPublished(Video $video): ?Video
    {
        /** @var Video|null $video */
        $video = Video::query()
            ->nextPublished($video)
            ->first();

        return $video;
    }
}
