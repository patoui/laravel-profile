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
        $user = $request->user();

        abort_if(!$user, 401);

        $user->toggleFavourite($comment);

        return redirect()->route('post.show', ['post_slug' => ($comment->post->slug ?? '')]);
    }
}
