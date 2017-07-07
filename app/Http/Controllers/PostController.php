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
}
