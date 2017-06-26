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
}
