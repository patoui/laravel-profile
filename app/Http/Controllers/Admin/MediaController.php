<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;

class MediaController extends Controller
{
    public function index()
    {
        $files = auth()->user()->getMedia();

        return view('admin.media.index')->with('files', $files);
    }

    public function create()
    {
        return view('admin.media.create');
    }

    public function edit(Media $media)
    {
        return view('admin.media.edit')->with('media', $media);
    }

    public function store(Request $request)
    {
        $this->validate($request, ['media' => 'required|file']);

        auth()->user()
            ->addMedia($request->file('media'))
            ->preservingOriginal()
            ->toMediaCollection();

        return redirect()->route('admin.media.index');
    }

    public function update(Request $request, Media $media)
    {
        $this->validate($request, ['name' => 'required|string']);

        $media->update(['name' => $request->input('name')]);

        return redirect()->route('admin.media.index');
    }

    public function delete(Media $media)
    {
        $media->delete();

        return redirect()->route('admin.media.index');
    }
}
