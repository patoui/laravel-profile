<?php

namespace App\Http\Controllers\Admin;

use App\Tip;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TipPublishController extends Controller
{
    /**
     * Publish a tip
     * @param  int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function show($id)
    {
        $tip = Tip::findOrFail($id);

        $tip->togglePublish();

        return redirect()->route('admin.dashboard');
    }
}
