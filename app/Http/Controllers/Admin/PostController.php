<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use App\Rules\Slug;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function create()
    {
        return view('admin.post.create')->with('post', new Post);
    }

    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'title' => 'required|string',
                'body' => 'required|string',
                'slug' => [
                    'required',
                    new Slug,
                    Rule::unique('posts', 'slug')
                ],
            ]
        );

        Post::create([
            'title' => $request->input('title'),
            'body' => $request->input('body'),
            'slug' => $request->input('slug')
        ]);

        return redirect()->route('admin.dashboard');
    }

    public function edit(Post $post)
    {
        return view('admin.post.edit')->with('post', $post);
    }

    public function update(Request $request, Post $post)
    {
        $this->validate($request, [
            'title' => 'required|string',
            'body' => 'required|string',
            'slug' => [
                'required',
                new Slug,
                Rule::unique('posts', 'slug')->ignore($post->id)
            ],
        ]);

        $post->update([
            'title' => $request->input('title'),
            'body' => $request->input('body'),
            'slug' => $request->input('slug')
        ]);

        return redirect()->route('admin.dashboard');
    }
}
