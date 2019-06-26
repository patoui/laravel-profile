<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Tip;
use function redirect;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class TipPublishController extends Controller
{
    public function show(Tip $tip) : RedirectResponse
    {
        $tip->togglePublish();

        return redirect()->route('admin.dashboard');
    }
}
