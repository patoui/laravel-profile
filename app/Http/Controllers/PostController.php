<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function show($slug)
    {
        $post = Post::findOrFailBySlug($slug);

        $post->analytics()->create([
            'headers' => json_encode(request()->headers->all())
        ]);

        return view('post.show')
            ->with('post', $post)
            ->with('comments', $post->comments);
    }
}
