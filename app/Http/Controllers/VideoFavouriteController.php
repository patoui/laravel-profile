<?php

namespace App\Http\Controllers;

use App\Video;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class VideoFavouriteController extends Controller
{
    public function store(Request $request, Video $video) : RedirectResponse
    {
        $user = $request->user();
        abort_if(!$user, 401);

        $user->toggleFavourite($video);

        return redirect()->route('video.show', ['video' => $video->slug]);
    }
}
