<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Post;
use App\Rules\Slug;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use function redirect;
use function view;

class PostController extends Controller
{
    public function create() : View
    {
        return view('admin.post.create')
            ->with('post', new Post())
            ->with('tags', []);
    }

    public function store(Request $request) : RedirectResponse
    {
        $request->validate([
            'title' => 'required|string',
            'body' => 'required|string',
            'slug' => [
                'required',
                new Slug(),
                Rule::unique('posts', 'slug'),
            ],
        ]);

        $post = Post::create([
            'title' => $request->input('title'),
            'body' => $request->input('body'),
            'slug' => $request->input('slug'),
        ]);

        $post->syncTags($request->input('tags', []));

        return redirect()->route('admin.dashboard');
    }

    public function edit(Post $post) : View
    {
        return view('admin.post.edit')
            ->with('post', $post)
            ->with('tags', $post->tags()->pluck('name'));
    }

    public function update(Request $request, Post $post) : RedirectResponse
    {
        $this->validate($request, [
            'title' => 'required|string',
            'body' => 'required|string',
            'slug' => [
                'required',
                new Slug(),
                Rule::unique('posts', 'slug')->ignore($post->id),
            ],
        ]);

        $post->update([
            'title' => $request->input('title'),
            'body' => $request->input('body'),
            'slug' => $request->input('slug'),
        ]);

        $tags = (array) $request->input('tags', []);

        $post->syncTags($tags);

        return redirect()->route('admin.dashboard');
    }
}
