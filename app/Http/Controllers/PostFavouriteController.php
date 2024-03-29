<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use function redirect;

class PostFavouriteController extends Controller
{
    public function store(Request $request, Post $post) : RedirectResponse
    {
        $user = $request->user();
        abort_if(!$user, 401);

        $user->toggleFavourite($post);

        return redirect()->route('post.show', ['post' => $post]);
    }
}
