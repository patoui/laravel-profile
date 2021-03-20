<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use function redirect;
use function view;

class MediaController extends Controller
{
    public function index(Request $request): Application|Factory|View
    {
        return view('admin.media.index')
            ->with('files', $request->user()->getMedia());
    }

    public function create(): Application|Factory|View
    {
        return view('admin.media.create');
    }

    public function edit(Media $media): Application|Factory|View
    {
        return view('admin.media.edit')->with('media', $media);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, ['media' => 'required|file']);

        $request->user()
                ->addMedia($request->file('media'))
                ->preservingOriginal()
                ->toMediaCollection();

        return redirect()->route('admin.media.index');
    }

    /**
     * @param Request $request
     * @param Media   $media
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function update(Request $request, Media $media): RedirectResponse
    {
        $this->validate($request, ['name' => 'required|string']);

        $media->update(['name' => $request->input('name')]);

        return redirect()->route('admin.media.index');
    }

    /**
     * @param Media $media
     * @return RedirectResponse
     * @throws Exception
     */
    public function delete(Media $media): RedirectResponse
    {
        $media->delete();

        return redirect()->route('admin.media.index');
    }
}
