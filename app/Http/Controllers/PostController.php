<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Analytic;
use App\Post;
use App\Repositories\PostRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\View\View;

final class PostController
{
    public function index(Request $request, PostRepository $postRepository): View
    {
        $posts = $postRepository->latestPublished(
            $request->input('tag') ? Arr::wrap($request->input('tag')) : null
        );

        return view('post.index', ['posts' => $posts]);
    }

    public function show(Request $request, Post $post, PostRepository $postRepository): View
    {
        Analytic::process($request, $post);

        return view('post.show', ['post' => $post, 'previousPost' => $postRepository->previousPublished($post), 'nextPost' => $postRepository->nextPublished($post)]);
    }
}
