<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Actions\Post\Create;
use App\Actions\Post\Update as PostUpdate;
use App\Http\Requests\Admin\Post\Create as PostCreate;
use App\Http\Requests\Admin\Post\Update;
use App\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

use function redirect;
use function view;

final class PostController
{
    public function create(): View
    {
        return view('admin.post.create', ['post' => new Post, 'tags' => []]);
    }

    public function store(PostCreate $request, Create $action): RedirectResponse
    {
        $action->execute($request->dto());

        return redirect()->route('admin.dashboard');
    }

    public function edit(Post $post): View
    {
        return view('admin.post.edit', ['post' => $post, 'tags' => $post->tags()->pluck('name')]);
    }

    public function update(Update $request, PostUpdate $action): RedirectResponse
    {
        $action->execute($request->dto());

        return redirect()->route('admin.dashboard');
    }
}
