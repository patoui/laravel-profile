<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Analytic;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\View\View;

class PostController extends Controller
{
    public function index(Request $request): View
    {
        $posts = Post::published()
            ->latest()
            ->when($request->input('tag'), function ($query) use ($request) {
                return $query->withAnyTags(Arr::wrap($request->input('tag')));
            })->get();

        return view('post.index', ['posts' => $posts]);
    }

    public function show(Request $request, Post $post): View
    {
        Analytic::process($request, $post);

        return view('post.show', ['post' => $post, 'previousPost' => $post->previousPublished(), 'nextPost' => $post->nextPublished()]);
    }
}
