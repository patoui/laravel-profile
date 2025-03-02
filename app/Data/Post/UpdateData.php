<?php

declare(strict_types=1);

namespace App\Data\Post;

use App\Post;
use Illuminate\Http\Request;
use Spatie\LaravelData\Data;

final class UpdateData extends Data
{
    public function __construct(
        public readonly Post $post,
        public readonly string $title,
        public readonly string $body,
        public readonly string $slug,
        public readonly array $tags = [],
    ) {}

    public static function fromRequest(Request $request): static
    {
        return self::from([
            'post' => Post::findOrFail($request->route('post')),
            'title' => $request->input('title'),
            'body' => $request->input('body'),
            'slug' => $request->input('slug'),
            'tags' => (array) $request->input('tags', []),
        ]);
    }
}
