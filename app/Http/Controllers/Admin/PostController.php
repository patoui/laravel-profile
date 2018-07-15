<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Post;
use App\Rules\Slug;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    public function create()
    {
        return view('admin.post.create')->with('post', new Post);
    }

    public function store()
    {
        $this->validate(
            request(),
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
            'title' => request('title'),
            'body' => request('body'),
            'slug' => request('slug')
        ]);

        return redirect()->route('admin.dashboard');
    }

    public function edit($id)
    {
        return view('admin.post.edit')->with('post', Post::findOrFail($id));
    }

    public function update($id)
    {
        $post = Post::findOrFail($id);

        $this->validate(
            request(),
            [
                'title' => 'required|string',
                'body' => 'required|string',
                'slug' => [
                    'required',
                    new Slug,
                    Rule::unique('posts', 'slug')->ignore($post->id)
                ],
            ]
        );

        $post->update([
            'title' => request('title'),
            'body' => request('body'),
            'slug' => request('slug')
        ]);

        return redirect()->route('admin.dashboard');
    }
}
