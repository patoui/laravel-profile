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
    public function index(): View
    {
        return view('admin.home', ['posts' => Post::with('tags')->withCount('analytics')->get(), 'postsCount' => Post::count(), 'postsPublishedCount' => Post::published()->count(), 'tips' => Tip::with('tags')->withCount('analytics')->get(), 'tipsCount' => Tip::count(), 'tipsPublishedCount' => Tip::published()->count(), 'videos' => Video::with('tags')->withCount('analytics')->get(), 'videosCount' => Video::count(), 'videosPublishedCount' => Video::published()->count()]);
    }
}
