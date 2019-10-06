<?php

namespace App\Http\Controllers\Admin;

use App\Rules\Slug;
use App\Video;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class VideoController extends Controller
{
    public function create() : View
    {
        return view('admin.video.create')
            ->with('video', new Video())
            ->with('tags', []);
    }

    public function store(Request $request) : RedirectResponse
    {
        $request->validate([
            'title' => 'required|string',
            'slug' => [
                'required',
                new Slug(),
                Rule::unique('videos', 'slug'),
            ],
            'external_id' => 'required|string|unique:videos,external_id',
            'tags' => 'nullable|array',
            'tags.*' => 'nullable|string|alpha_num',
        ]);

        $video = Video::create([
            'title' => $request->input('title'),
            'slug' => $request->input('slug'),
            'external_id' => $request->input('external_id'),
        ]);

        if ($request->has('tags')) {
            $video->syncTags($request->input('tags', []));
        }

        return redirect()->route('admin.dashboard');
    }

    public function edit(Video $video) : View
    {
        return view('admin.video.edit')
            ->with('video', $video)
            ->with('tags', $video->tags()->pluck('name'));
    }

    public function update(Request $request, Video $video) : RedirectResponse
    {
        $request->validate([
            'title' => 'required|string',
            'slug' => [
                'required',
                new Slug(),
                Rule::unique('videos', 'slug'),
            ],
            'external_id' => 'required|string|unique:videos,external_id',
            'tags' => 'nullable|array',
            'tags.*' => 'nullable|string|alpha_num',
        ]);

        $video->update([
            'title' => $request->input('title'),
            'slug' => $request->input('slug'),
            'external_id' => $request->input('external_id'),
        ]);

        if ($request->has('tags')) {
            $video->syncTags($request->input('tags', []));
        }

        return redirect()->route('admin.dashboard');
    }
}
