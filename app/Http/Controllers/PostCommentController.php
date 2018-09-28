<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
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
        $post = Post::slug($slug)->firstOrFail();

        // Validate comment input
        $this->validate(
            request(),
            ['body' => 'required|string'],
            ['required' => 'A comment usually has something in it xD']
        );

        // Create comment for post
        $comment = $post->createComment([
            'body' => request('body'),
            'comment_id' => request('comment_id'),
            'user_id' => auth()->id(),
        ]);

        return request()->expectsJson() ?
            ['success' => 'Successfully saved comment'] :
            redirect()->route('post.show', ['slug' => $post->slug]);
    }
}
