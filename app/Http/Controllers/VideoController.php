<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Analytic;
use App\Video;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VideoController extends Controller
{
    public function index(): View
    {
        return view('video.index')->with('videos', Video::published()->get());
    }

    public function show(Request $request, Video $video): View
    {
        abort_if(!$video->published_at, 404);

        Analytic::process($request, $video);

        return view('video.show')
            ->with('video', $video)
            ->with('previousVideo', $video->previousPublished())
            ->with('nextVideo', $video->nextPublished());
    }
}
