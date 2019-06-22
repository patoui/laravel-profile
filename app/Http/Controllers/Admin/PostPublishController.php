<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use App\Http\Controllers\Controller;

class PostPublishController extends Controller
{
    public function show(Post $post)
    {
        $post->togglePublish();

        return redirect()->route('admin.dashboard');
    }
}
