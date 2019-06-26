<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\RedirectResponse;
use function redirect;

class PostPublishController extends Controller
{
    public function show(Post $post) : RedirectResponse
    {
        $post->togglePublish();

        return redirect()->route('admin.dashboard');
    }
}
