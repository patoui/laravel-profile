<?php

namespace App\Http\Controllers;

use App\Tip;
use Illuminate\Http\Request;

class TipController extends Controller
{
    public function index()
    {
        return view('tip.index')
            ->with('tips', Tip::published()->latest()->get());
    }

    /**
     * Display tip details
     *
     * @param  string $slug
     * @return \Illuminate\View\View
     */
    public function show($slug)
    {
        // Find tip by the slug or 404
        $tip = Tip::slug($slug)->firstOrFail();

        // Create analytics entry
        $tip->analytics()->create([
            'headers' => json_encode(request()->headers->all())
        ]);

        return view('tip.show')
            ->with('tip', $tip)
            ->with('previousTip', $tip->previousPublished())
            ->with('nextTip', $tip->nextPublished());
    }
}
