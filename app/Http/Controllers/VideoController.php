<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Analytic;
use App\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\View\View;

class VideoController extends Controller
{
    public function index(Request $request): View
    {
        $videos = Video::published()
            ->latest()
            ->when($request->input('tag'), function ($query) use ($request) {
                return $query->withAnyTags(Arr::wrap($request->input('tag')));
            })->get();

        return view('video.index', ['videos' => $videos]);
    }

    public function show(Request $request, Video $video): View
    {
        abort_if(! $video->published_at, 404);

        Analytic::process($request, $video);

        return view('video.show', ['video' => $video, 'previousVideo' => $video->previousPublished(), 'nextVideo' => $video->nextPublished()]);
    }
}
