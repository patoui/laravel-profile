<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Post;
use App\Repositories\PostRepository;
use Illuminate\Http\RedirectResponse;

use function redirect;

final class PostPublishController
{
    public function show(Post $post, PostRepository $postRespository): RedirectResponse
    {
        $postRespository->togglePublish($post);

        return redirect()->route('admin.dashboard');
    }
}
