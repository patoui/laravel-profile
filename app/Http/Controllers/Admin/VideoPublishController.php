<?php

namespace App\Http\Controllers\Admin;

use App\Video;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;

class VideoPublishController extends Controller
{
    public function show(Video $video) : RedirectResponse
    {
        $video->togglePublish();

        return redirect()->route('admin.dashboard');
    }
}
