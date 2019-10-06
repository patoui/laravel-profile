<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Post;
use App\Tip;
use App\Video;
use Illuminate\View\View;
use function view;

class DashboardController extends Controller
{
    public function index() : View
    {
        return view('admin.home')
            ->with('posts', Post::withCount('analytics')->get())
            ->with('postsCount', Post::count())
            ->with('postsPublishedCount', Post::published()->count())
            ->with('tips', Tip::withCount('analytics')->get())
            ->with('tipsCount', Tip::count())
            ->with('tipsPublishedCount', Tip::published()->count())
            ->with('videos', Video::withCount('analytics')->get())
            ->with('videosCount', Video::count())
            ->with('videosPublishedCount', Video::published()->count());
    }
}
