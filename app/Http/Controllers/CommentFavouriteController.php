<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Comment;
use function redirect;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class CommentFavouriteController extends Controller
{
    public function store(Request $request, Comment $comment) : RedirectResponse
    {
        $request->user()->toggleFavourite($comment);

        return redirect()->route('post.show', ['slug' => $comment->post->slug]);
    }
}
