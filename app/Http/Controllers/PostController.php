<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::whereNotNull('published_at')->get();

        return view('post.index', compact('posts'));
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);

        return view('post.show', compact('post'));
    }

    public function create()
    {
        $this->middleware('auth');

        $post = new Post;

        return view('post.create', compact('post'));
    }

    public function store()
    {
        $this->middleware('auth');

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
        $this->middleware('auth');

        $post = Post::findOrFail($id);

        return view('post.edit', compact('post'));
    }

    public function update($id)
    {
        $this->middleware('auth');

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
