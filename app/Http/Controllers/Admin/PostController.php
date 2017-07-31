<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
                'url' => 'required|unique:posts,url',
            ]
        );

        Post::create([
            'title' => request('title'),
            'body' => request('body'),
            'url' => request('url')
        ]);

        return redirect()->route('admin.dashboard');
    }

    public function publish($id)
    {
        $post = Post::findOrFail($id);

        $post->togglePublish();

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
            ]
        );

        $post->update([
            'title' => request('title'),
            'body' => request('body')
        ]);

        return redirect()->route('admin.dashboard');
    }
}
