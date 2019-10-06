<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Video;
use Illuminate\View\View;

class VideoController extends Controller
{
    public function index() : View
    {
        return view('video.index')->with('videos', Video::get());
    }

    public function show(Video $video) : View
    {
        return view('video.show')
            ->with('video', $video)
            ->with('previousVideo', $video->previousPublished())
            ->with('nextVideo', $video->nextPublished());
    }
}
