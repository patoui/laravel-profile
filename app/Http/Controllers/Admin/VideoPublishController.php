<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Repositories\VideoRepository;
use App\Video;
use Illuminate\Http\RedirectResponse;

final class VideoPublishController
{
    public function show(Video $video, VideoRepository $videoRepository): RedirectResponse
    {
        $videoRepository->togglePublish($video);

        return redirect()->route('admin.dashboard');
    }
}
