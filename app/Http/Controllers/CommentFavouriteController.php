<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Favourite;
use Illuminate\Http\Request;

class CommentFavouriteController extends Controller
{
    public function store(Comment $comment)
    {
        $favourite = auth()->user()->toggleFavourite($comment);

        // Redirect back to the post
        return redirect()->route('post.show', ['slug' => $comment->post->slug]);
    }
}
