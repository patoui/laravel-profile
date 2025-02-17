<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Video;
use Illuminate\Http\RedirectResponse;

class VideoPublishController extends Controller
{
    public function show(Video $video): RedirectResponse
    {
        $video->togglePublish();

        return redirect()->route('admin.dashboard');
    }
}
