<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.home')
            ->with('postsCount', Post::count())
            ->with(
                'postsPublishedCount',
                Post::whereNotNull('published_at')->count()
            )
            ->with('posts', Post::get());
    }
}
