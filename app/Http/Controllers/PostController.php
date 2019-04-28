<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::published()->latest()->get();

        return view('post.index')->with('posts', $posts);
    }

    public function show($slug)
    {
        $post = Post::with('comments.owner')->slug($slug)->firstOrFail();

        $post->analytics()->create([
            'headers' => json_encode(request()->headers->all())
        ]);

        return view('post.show')
            ->with('post', $post)
            ->with('previousPost', $post->previousPublished())
            ->with('nextPost', $post->nextPublished());
    }
}
