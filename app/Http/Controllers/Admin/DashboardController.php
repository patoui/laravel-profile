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
        return view('admin.home', ['posts' => Post::with('tags')->withCount('analytics')->get(), 'postsCount' => Post::count(), 'postsPublishedCount' => Post::query()->published()->count(), 'tips' => Tip::with('tags')->withCount('analytics')->get(), 'tipsCount' => Tip::count(), 'tipsPublishedCount' => Tip::query()->published()->count(), 'videos' => Video::with('tags')->withCount('analytics')->get(), 'videosCount' => Video::count(), 'videosPublishedCount' => Video::query()->published()->count()]);
    }
}
