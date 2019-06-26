<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Tip;
use App\Post;
use function view;
use Illuminate\View\View;
use App\Http\Controllers\Controller;

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
            ->with('tipsPublishedCount', Tip::published()->count());
    }
}
