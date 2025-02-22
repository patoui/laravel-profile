<?php

namespace App\Http\Controllers\Admin;

use App\Video;
use Illuminate\Http\RedirectResponse;

class VideoPublishController
{
    public function show(Video $video): RedirectResponse
    {
        $video->togglePublish();

        return redirect()->route('admin.dashboard');
    }
}
