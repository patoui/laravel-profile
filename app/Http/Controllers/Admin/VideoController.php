<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Repositories\VideoRepository;
use App\Rules\Slug;
use App\Video;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

final class VideoController
{
    public function create(): View
    {
        return view('admin.video.create', ['video' => new Video, 'tags' => []]);
    }

    public function store(Request $request, VideoRepository $videoRepository): RedirectResponse
    {
        $request->validate([
            'title' => 'required|string',
            'slug' => [
                'required',
                new Slug,
                Rule::unique('videos', 'slug'),
            ],
            'external_id' => 'required|string|unique:videos,external_id',
            'tags' => 'nullable|array',
            'tags.*' => 'nullable|string|alpha_num',
        ]);

        $videoRepository->create(
            title: $request->input('title'),
            slug: $request->input('slug'),
            externalId: $request->input('external_id'),
            tags: $request->input('tags', []),
        );

        return redirect()->route('admin.dashboard');
    }

    public function edit(Video $video): View
    {
        return view('admin.video.edit', ['video' => $video, 'tags' => $video->tags()->pluck('name')]);
    }

    public function update(Request $request, Video $video, VideoRepository $videoRepository): RedirectResponse
    {
        $request->validate([
            'title' => 'required|string',
            'slug' => [
                'required',
                new Slug,
                Rule::unique('videos', 'slug'),
            ],
            'external_id' => 'required|string|unique:videos,external_id',
            'tags' => 'nullable|array',
            'tags.*' => 'nullable|string|alpha_num',
        ]);

        $videoRepository->update(
            video: $video,
            title: $request->input('title'),
            slug: $request->input('slug'),
            externalId: $request->input('external_id'),
            tags: $request->input('tags', []),
        );

        return redirect()->route('admin.dashboard');
    }
}
