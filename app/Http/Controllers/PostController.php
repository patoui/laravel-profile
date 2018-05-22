<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * List published posts
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Get published posts
        $posts = Post::published()->latest()->get();

        return view('post.index')
            ->with('posts', $posts);
    }

    /**
     * Display post details
     *
     * @param  string $slug
     * @return \Illuminate\View\View
     */
    public function show($slug)
    {
        // Find post by the slug or 404
        $post = Post::findOrFailBySlug($slug);

        // Create analytics entry
        $post->analytics()->create([
            'headers' => json_encode(request()->headers->all())
        ]);

        return view('post.show')
            ->with('post', $post)
            ->with('previousPost', $post->previousPublished())
            ->with('comments', $post->comments);
    }
}
