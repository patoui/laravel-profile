<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

class CommentFavouriteController extends Controller
{
    public function store(Request $request, Comment $comment)
    {
        $request->user()->toggleFavourite($comment);

        return redirect()->route('post.show', ['slug' => $comment->post->slug]);
    }
}
