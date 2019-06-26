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
        return view('admin.post.create')->with('post', new Post());
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

        Post::create([
            'title' => $request->input('title'),
            'body' => $request->input('body'),
            'slug' => $request->input('slug'),
        ]);

        return redirect()->route('admin.dashboard');
    }

    public function edit(Post $post) : View
    {
        return view('admin.post.edit')->with('post', $post);
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

        return redirect()->route('admin.dashboard');
    }
}
