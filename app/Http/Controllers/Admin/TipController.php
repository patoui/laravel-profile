<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Rules\Slug;
use App\Tip;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use function redirect;
use function request;
use function view;

class TipController extends Controller
{
    public function create() : View
    {
        return view('admin.tip.create')
            ->with('tip', new Tip())
            ->with('tags', []);
    }

    public function store(Request $request) : RedirectResponse
    {
        $request->validate([
            'title' => 'required|string',
            'body' => 'required|string',
            'slug' => [
                'required',
                new Slug(),
                Rule::unique('tips', 'slug'),
            ],
            'tags' => 'nullable|array',
            'tags.*' => 'nullable|string|alpha_num',
        ]);

        $tip = Tip::create([
            'title' => $request->input('title'),
            'body' => $request->input('body'),
            'slug' => $request->input('slug'),
        ]);

        $tip->syncTags($request->input('tags', []));

        return redirect()->route('admin.dashboard');
    }

    public function edit(Tip $tip) : View
    {
        return view('admin.tip.edit')
            ->with('tip', $tip)
            ->with('tags', $tip->tags()->pluck('name'));
    }

    public function update(Request $request, Tip $tip) : RedirectResponse
    {
        $request->validate([
            'title' => 'required|string',
            'body' => 'required|string',
            'slug' => [
                'required',
                new Slug(),
                Rule::unique('tips', 'slug')->ignore($tip->id),
            ],
            'tags' => 'nullable|array',
            'tags.*' => 'nullable|string|alpha_num',
        ]);

        $tip->update([
            'title' => request('title'),
            'body' => request('body'),
            'slug' => request('slug'),
        ]);

        $tags = (array) $request->input('tags', []);

        $tip->syncTags($tags);

        return redirect()->route('admin.dashboard');
    }
}
