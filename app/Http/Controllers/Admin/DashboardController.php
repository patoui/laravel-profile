<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Post;
use App\Tip;
use App\Video;
use Illuminate\View\View;

use function view;

final class DashboardController
{
    public function index(): View
    {
        return view('admin.home')
            ->with('posts', Post::with('tags')->withCount('analytics')->get())
            ->with('postsCount', Post::count())
            ->with('postsPublishedCount', Post::query()->published()->count())
            ->with('tips', Tip::with('tags')->withCount('analytics')->get())
            ->with('tipsCount', Tip::count())
            ->with('tipsPublishedCount', Tip::query()->published()->count())
            ->with('videos', Video::with('tags')->withCount('analytics')->get())
            ->with('videosCount', Video::count())
            ->with('videosPublishedCount', Video::query()->published()->count());
    }
}
