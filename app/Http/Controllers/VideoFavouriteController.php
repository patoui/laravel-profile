<?php

namespace App\Http\Controllers;

use App\Video;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class VideoFavouriteController extends Controller
{
    public function store(Request $request, Video $video) : RedirectResponse
    {
        $request->user()->toggleFavourite($video);

        return redirect()->route('video.show', ['slug' => $video->slug]);
    }
}
