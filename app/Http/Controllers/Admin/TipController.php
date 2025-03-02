<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Repositories\TipRepository;
use App\Rules\Slug;
use App\Tip;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

use function redirect;
use function view;

final class TipController
{
    public function create(): View
    {
        return view('admin.tip.create', ['tip' => new Tip, 'tags' => []]);
    }

    public function store(Request $request, TipRepository $tipRepository): RedirectResponse
    {
        $request->validate([
            'title' => 'required|string',
            'body' => 'required|string',
            'slug' => [
                'required',
                new Slug,
                Rule::unique('tips', 'slug'),
            ],
            'tags' => 'nullable|array',
            'tags.*' => 'nullable|string|alpha_num',
        ]);

        $tipRepository->create(
            title: $request->input('title'),
            body: $request->input('body'),
            slug: $request->input('slug'),
            tags: $request->input('tags', []),
        );

        return redirect()->route('admin.dashboard');
    }

    public function edit(Tip $tip): View
    {
        return view('admin.tip.edit', ['tip' => $tip, 'tags' => $tip->tags()->pluck('name')]);
    }

    public function update(Request $request, Tip $tip, TipRepository $tipRepository): RedirectResponse
    {
        $request->validate([
            'title' => 'required|string',
            'body' => 'required|string',
            'slug' => [
                'required',
                new Slug,
                Rule::unique('tips', 'slug')->ignore($tip->id),
            ],
            'tags' => 'nullable|array',
            'tags.*' => 'nullable|string|alpha_num',
        ]);

        $tipRepository->update(
            tip: $tip,
            title: $request->input('title'),
            body: $request->input('body'),
            slug: $request->input('slug'),
            tags: (array) $request->input('tags', []),
        );

        return redirect()->route('admin.dashboard');
    }
}
