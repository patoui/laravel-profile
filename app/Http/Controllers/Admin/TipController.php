<?php

namespace App\Http\Controllers\Admin;

use App\Tip;
use App\Rules\Slug;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class TipController extends Controller
{
    public function create()
    {
        return view('admin.tip.create')
            ->with('tip', new Tip)
            ->with('tags', []);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'body' => 'required|string',
            'slug' => [
                'required',
                new Slug,
                Rule::unique('tips', 'slug')
            ],
            'tags' => 'nullable|array',
            'tags.*' => 'nullable|string|alpha_num',
        ]);

        $tip = Tip::create([
            'title' => $request->input('title'),
            'body' => $request->input('body'),
            'slug' => $request->input('slug')
        ]);

        $tip->addTags($request->input('tags', []));

        return redirect()->route('admin.dashboard');
    }

    public function edit(Tip $tip)
    {
        return view('admin.tip.edit')
            ->with('tip', $tip)
            ->with('tags', $tip->tags()->pluck('name'));
    }

    public function update(Request $request, Tip $tip)
    {
        $request->validate([
            'title' => 'required|string',
            'body' => 'required|string',
            'slug' => [
                'required',
                new Slug,
                Rule::unique('tips', 'slug')->ignore($tip->id)
            ],
            'tags' => 'nullable|array',
            'tags.*' => 'nullable|string|alpha_num',
        ]);

        $tip->update([
            'title' => request('title'),
            'body' => request('body'),
            'slug' => request('slug')
        ]);

        $tip->addTags($request->input('tags', []));

        return redirect()->route('admin.dashboard');
    }
}
