<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use function view;
use function redirect;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Spatie\MediaLibrary\Models\Media;

class MediaController extends Controller
{
    public function index(Request $request) : View
    {
        return view('admin.media.index')
            ->with('files', $request->user()->getMedia());
    }

    public function create() : View
    {
        return view('admin.media.create');
    }

    public function edit(Media $media) : View
    {
        return view('admin.media.edit')->with('media', $media);
    }

    public function store(Request $request) : RedirectResponse
    {
        $this->validate($request, ['media' => 'required|file']);

        $request->user()
            ->addMedia($request->file('media'))
            ->preservingOriginal()
            ->toMediaCollection();

        return redirect()->route('admin.media.index');
    }

    public function update(Request $request, Media $media) : RedirectResponse
    {
        $this->validate($request, ['name' => 'required|string']);

        $media->update(['name' => $request->input('name')]);

        return redirect()->route('admin.media.index');
    }

    public function delete(Media $media) : RedirectResponse
    {
        $media->delete();

        return redirect()->route('admin.media.index');
    }
}
