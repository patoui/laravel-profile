<?php

namespace App\Http\Controllers;

use App\Tip;
use Illuminate\Http\Request;

class TipController extends Controller
{
    public function index()
    {
        // TODO: clean this up
        $tip = Tip::with('tags')
            ->published()
            ->latest()
            ->when(request('tag'), function ($query) {
                return $query->whereIn('tips.id', function ($q) {
                    return $q->from('tag_tip')
                        ->select('tip_id')
                        ->where('tag_id', function ($inner) {
                            return $inner->from('tags')
                                ->select('tags.id')
                                ->where('tags.name', request('tag'))
                                ->pluck('tags.id');
                        });
                });
            })
            ->get();

        return view('tip.index')->with('tips', $tip);
    }

    /**
     * Display tip details.
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
