<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Data\Post\StoreData;
use App\Data\Post\UpdateData;
use App\Post;
use App\Repositories\Traits\PublishesRepository;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

final class PostRepository
{
    use PublishesRepository;

    public function create(StoreData $data): Post
    {
        $post = new Post;

        $post->title = $data->title;
        $post->body = $data->body;
        $post->slug = $data->slug;

        DB::transaction(function () use ($post, $data) {
            $post->save();
            $post->syncTags($data->tags);
        });

        return $post;
    }

    public function update(UpdateData $data): Post
    {
        $post = $data->post;
        $post->title = $data->title;
        $post->body = $data->body;
        $post->slug = $data->slug;

        DB::transaction(function () use ($post, $data) {
            $post->save();
            $post->syncTags($data->tags);
        });

        return $post;
    }

    public function latestPublished(?array $tags = null): Collection
    {
        return Post::query()
            ->published()
            ->latest()
            ->when($tags, fn (Builder $query) => $query->withAnyTags($tags))
            ->get();
    }

    public function previousPublished(Post $post): ?Post
    {
        /** @var Post|null $post */
        $post = Post::query()
            ->previousPublished($post)
            ->first();

        return $post;
    }

    public function nextPublished(Post $post): ?Post
    {
        /** @var Post|null $post */
        $post = Post::query()
            ->nextPublished($post)
            ->first();

        return $post;
    }
}
