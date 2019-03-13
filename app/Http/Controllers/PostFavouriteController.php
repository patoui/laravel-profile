<?php

namespace App\Http\Controllers;

use App\Post;

class PostFavouriteController extends Controller
{
    /**
     * Favourite a post.
     *
     * @param  string $slug
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store($slug)
    {
        // Find post by slug or throw exception
        $post = Post::slug($slug)->firstOrFail();

        $favourite = auth()->user()->toggleFavourite($post);

        // Redirect back to the post
        return redirect()->route('post.show', ['slug' => $slug]);
    }
}
