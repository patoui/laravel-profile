<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Post;
use App\Repositories\PostRepository;
use App\Rules\Slug;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

use function redirect;
use function view;

final class PostController
{
    public function create(): View
    {
        return view('admin.post.create', ['post' => new Post, 'tags' => []]);
    }

    public function store(Request $request, PostRepository $postRepository): RedirectResponse
    {
        $request->validate([
            'title' => 'required|string',
            'body' => 'required|string',
            'slug' => [
                'required',
                new Slug,
                Rule::unique('posts', 'slug'),
            ],
        ]);

        $postRepository->create(
            title: $request->input('title'),
            body: $request->input('body'),
            slug: $request->input('slug'),
            tags: $request->input('tags', []),
        );

        return redirect()->route('admin.dashboard');
    }

    public function edit(Post $post): View
    {
        return view('admin.post.edit', ['post' => $post, 'tags' => $post->tags()->pluck('name')]);
    }

    public function update(Request $request, Post $post, PostRepository $postRepository): RedirectResponse
    {
        $request->validate([
            'title' => 'required|string',
            'body' => 'required|string',
            'slug' => [
                'required',
                new Slug,
                Rule::unique('posts', 'slug')->ignore($post->id),
            ],
        ]);

        $postRepository->update(
            post: $post,
            title: $request->input('title'),
            body: $request->input('body'),
            slug: $request->input('slug'),
            tags: $request->input('tags', [])
        );

        return redirect()->route('admin.dashboard');
    }
}
