<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use function redirect;

class PostFavouriteController extends Controller
{
    public function store(Request $request, string $slug) : RedirectResponse
    {
        $post = Post::slug($slug)->firstOrFail();

        $request->user()->toggleFavourite($post);

        return redirect()->route('post.show', ['post' => $slug]);
    }
}
