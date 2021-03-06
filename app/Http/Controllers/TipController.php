<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Analytic;
use App\Tip;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\View\View;

class TipController extends Controller
{
    public function index(Request $request) : View
    {
        $tip = Tip::with('tags')
            ->published()
            ->latest()
            ->when($request->input('tag'), function ($query) use ($request) {
                return $query->withAnyTags(Arr::wrap($request->input('tag')));
            })->get();

        return view('tip.index')->with('tips', $tip);
    }

    public function show(Request $request, Tip $tip) : View
    {
        Analytic::process($request, $tip);

        return view('tip.show')
            ->with('tip', $tip)
            ->with('previousTip', $tip->previousPublished())
            ->with('nextTip', $tip->nextPublished());
    }
}
