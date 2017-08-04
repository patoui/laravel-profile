<?php

namespace App\Http\Controllers;

use App\Post;
use App\Comment;
use Illuminate\Http\Request;

class PostCommentController extends Controller
{
    /**
     * Store a new comment for the given post
     *
     * @param  string $slug the post slug
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store($slug)
    {
        // Find post by slug or throw exception
        $post = Post::findOrFailBySlug($slug);

        // Validate comment input
        $this->validate(
            request(),
            ['body' => 'required|string'],
            ['required' => 'A comment usually has something in it xD']
        );

        // Create comment for post
        $post->createComment(['body' => request('body')]);

        // Redirect back to the post
        return redirect()->route('post.show', ['slug' => $post->slug]);
    }
}