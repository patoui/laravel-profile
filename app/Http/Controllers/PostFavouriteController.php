<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostFavouriteController extends Controller
{
    public function store(Request $request, string $slug)
    {
        $post = Post::slug($slug)->firstOrFail();

        $request->user()->toggleFavourite($post);

        return redirect()->route('post.show', ['slug' => $slug]);
    }
}
