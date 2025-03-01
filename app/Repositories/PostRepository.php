<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Post;
use App\Repositories\Traits\PublishesRepository;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

final class PostRepository
{
    use PublishesRepository;

    public function create(
        string $title,
        string $body,
        string $slug,
        array $tags = [],
    ) {
        $post = new Post();

        $post->title = $title;
        $post->body = $body;
        $post->slug = $slug;

        DB::transaction(function () use ($post, $tags) {
            $post->save();
            $post->syncTags($tags);
        });

        return $post;
    }

    public function update(
        Post $post,
        string $title,
        string $body,
        string $slug,
        array $tags = [],
    ) {
        $post->title = $title;
        $post->body = $body;
        $post->slug = $slug;

        DB::transaction(function () use ($post, $tags) {
            $post->save();
            $post->syncTags($tags);
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
