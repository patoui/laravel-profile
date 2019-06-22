<?php

namespace App\Http\Controllers\Admin;

use App\Tip;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class TipPublishController extends Controller
{
    public function show(Tip $tip): RedirectResponse
    {
        $tip->togglePublish();

        return redirect()->route('admin.dashboard');
    }
}
