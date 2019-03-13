<?php

namespace App\Http\Controllers;

use App\Tip;

class TipFavouriteController extends Controller
{
    /**
     * Favourite a tip.
     *
     * @param  string $slug
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store($slug)
    {
        // Find tip by slug or throw exception
        $tip = Tip::slug($slug)->firstOrFail();

        $favourite = auth()->user()->toggleFavourite($tip);

        // Redirect back to the tip
        return redirect()->route('tip.show', ['slug' => $slug]);
    }
}
