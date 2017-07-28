<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function create()
    {
        $post = new Post;

        return view('post.create', compact('post'));
    }

    public function store()
    {
        $this->validate(
            request(),
            [
                'title' => 'required|string',
                'body' => 'required|string',
            ]
        );

        Post::create([
            'title' => request('title'),
            'body' => request('body')
        ]);

        return redirect()->route('dashboard');
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);

        return view('post.edit', compact('post'));
    }

    public function update($id)
    {
        $post = Post::findOrFail($id);

        $this->validate(
            request(),
            [
                'title' => 'required|string',
                'body' => 'required|string',
            ]
        );

        $post->update([
            'title' => request('title'),
            'body' => request('body')
        ]);

        return redirect()->route('dashboard');
    }
}
