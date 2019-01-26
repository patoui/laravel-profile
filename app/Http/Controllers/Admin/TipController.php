<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Tip;
use App\Rules\Slug;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TipController extends Controller
{
    public function create()
    {
        return view('admin.tip.create')->with('tip', new Tip);
    }

    public function store()
    {
        $this->validate(
            request(),
            [
                'title' => 'required|string',
                'body' => 'required|string',
                'slug' => [
                    'required',
                    new Slug,
                    Rule::unique('tips', 'slug')
                ],
            ]
        );

        Tip::create([
            'title' => request('title'),
            'body' => request('body'),
            'slug' => request('slug')
        ]);

        return redirect()->route('admin.dashboard');
    }

    public function edit($id)
    {
        return view('admin.tip.edit')->with('tip', Tip::findOrFail($id));
    }

    public function update($id)
    {
        $tip = Tip::findOrFail($id);

        $this->validate(
            request(),
            [
                'title' => 'required|string',
                'body' => 'required|string',
                'slug' => [
                    'required',
                    new Slug,
                    Rule::unique('tips', 'slug')->ignore($tip->id)
                ],
            ]
        );

        $tip->update([
            'title' => request('title'),
            'body' => request('body'),
            'slug' => request('slug')
        ]);

        return redirect()->route('admin.dashboard');
    }
}
