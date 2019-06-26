<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Post;
use function redirect;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class PostFavouriteController extends Controller
{
    public function store(Request $request, string $slug) : RedirectResponse
    {
        $post = Post::slug($slug)->firstOrFail();

        $request->user()->toggleFavourite($post);

        return redirect()->route('post.show', ['slug' => $slug]);
    }
}
