<?php

namespace App\Http\Controllers;

use App\Tip;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TipFavouriteController extends Controller
{
    public function store(Request $request, string $slug): RedirectResponse
    {
        $tip = Tip::slug($slug)->firstOrFail();

        $request->user()->toggleFavourite($tip);

        return redirect()->route('tip.show', ['slug' => $slug]);
    }
}
