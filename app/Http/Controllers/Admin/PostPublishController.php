<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Post;
use function redirect;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class PostPublishController extends Controller
{
    public function show(Post $post) : RedirectResponse
    {
        $post->togglePublish();

        return redirect()->route('admin.dashboard');
    }
}
