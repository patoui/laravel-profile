<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Tip;
use Illuminate\Http\Request;
use Illuminate\View\View;
use function json_encode;
use function view;

class TipController extends Controller
{
    public function index(Request $request) : View
    {
        $tip = Tip::with('tags')
            ->published()
            ->latest()
            ->when($request->input('tag'), static function ($query) use ($request) {
                return $query->whereIn('tips.id', static function ($q) use ($request) {
                    return $q->from('tag_tip')
                        ->select('tip_id')
                        ->where('tag_id', static function ($inner) use ($request) {
                            return $inner->from('tags')
                                ->select('tags.id')
                                ->where('tags.name', $request->input('tag'))
                                ->pluck('tags.id');
                        });
                });
            })->get();

        return view('tip.index')->with('tips', $tip);
    }

    public function show(Request $request, string $slug) : View
    {
        $tip = Tip::slug($slug)->firstOrFail();

        $tip->analytics()->create([
            'headers' => json_encode($request->headers->all()),
        ]);

        return view('tip.show')
            ->with('tip', $tip)
            ->with('previousTip', $tip->previousPublished())
            ->with('nextTip', $tip->nextPublished());
    }
}
