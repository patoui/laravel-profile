<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Spatie\MediaLibrary\Media;
use App\Http\Controllers\Controller;

class MediaController extends Controller
{
    /**
     * List all media items for the current user.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $files = auth()->user()->getMedia();

        return view('admin.media.index')
            ->with('files', $files);
    }

    /**
     * Display view to add new media.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.media.create');
    }

    /**
     * Display view to add new media.
     *
     * @return \Illuminate\View\View
     */
    public function edit(Media $media)
    {
        return view('admin.media.edit')
            ->with('media', $media);
    }

    /**
     * Upload the file to the media library.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        $this->validate(
            request(),
            ['media' => 'required|file']
        );

        auth()->user()
            ->addMedia(request()->file('media'))
           ->preservingOriginal()
           ->toMediaCollection();

        return redirect()->route('admin.media.index');
    }

    /**
     * Display view to add new media.
     *
     * @return \Illuminate\View\View
     */
    public function update(Request $request, Media $media)
    {
        $this->validate($request, [
            'name' => 'required|string',
        ]);

        $media->update(['name' => $request->input('name')]);

        return redirect()->route('admin.media.index');
    }

    /**
     * Delete a file to from media library.
     *
     * @param Media $media
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Media $media)
    {
        $media->delete();

        return redirect()->route('admin.media.index');
    }
}
