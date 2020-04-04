<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use function redirect;

class CommentFavouriteController extends Controller
{
    public function store(Request $request, Comment $comment) : RedirectResponse
    {
        $request->user()->toggleFavourite($comment);

        return redirect()->route('post.show', ['post' => ($comment->post->slug ?? '')]);
    }
}
