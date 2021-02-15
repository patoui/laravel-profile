<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\View\View;
use function json_encode;
use function view;

class PostController extends Controller
{
    public function index(): View
    {
        $posts = Post::published()->latest()->get();

        return view('post.index')->with('posts', $posts);
    }

    public function show(Request $request, Post $post): View
    {
        $post->analytics()->create([
            'headers' => json_encode($request->headers->all()),
        ]);

        return view('post.show')
            ->with('post', $post)
            ->with('previousPost', $post->previousPublished())
            ->with('nextPost', $post->nextPublished());
    }
}
