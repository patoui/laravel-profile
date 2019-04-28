<?php

namespace App\Http\Controllers;

use App\Post;
use App\Comment;
use Illuminate\Http\Request;

class PostCommentController extends Controller
{
    public function store($slug)
    {
        $post = Post::slug($slug)->firstOrFail();

        $this->validate(
            request(),
            ['body' => 'required|string'],
            ['required' => 'A comment usually has something in it xD']
        );

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
