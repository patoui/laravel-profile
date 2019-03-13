<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use App\Http\Controllers\Controller;

class PostPublishController extends Controller
{
    /**
     * Publish a post.
     * @param  int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);

        $post->togglePublish();

        return redirect()->route('admin.dashboard');
    }
}
