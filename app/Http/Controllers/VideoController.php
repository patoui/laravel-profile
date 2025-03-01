<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Analytic;
use App\Repositories\VideoRepository;
use App\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\View\View;

final class VideoController
{
    public function index(Request $request, VideoRepository $videoRepository): View
    {
        $videos = $videoRepository->latestPublished(
            $request->input('tag') ? Arr::wrap($request->input('tag')) : null
        );

        return view('video.index', ['videos' => $videos]);
    }

    public function show(Request $request, Video $video, VideoRepository $videoRepository): View
    {
        abort_if(! $video->published_at, 404);

        Analytic::process($request, $video);

        return view('video.show', ['video' => $video, 'previousVideo' => $videoRepository->previousPublished($video), 'nextVideo' => $videoRepository->nextPublished($video)]);
    }
}
