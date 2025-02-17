<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Tip;
use Illuminate\Http\RedirectResponse;

use function redirect;

class TipPublishController extends Controller
{
    public function show(Tip $tip): RedirectResponse
    {
        $tip->togglePublish();

        return redirect()->route('admin.dashboard');
    }
}
