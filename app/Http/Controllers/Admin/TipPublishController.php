<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Tip;
use Illuminate\Http\RedirectResponse;

use function redirect;

final class TipPublishController
{
    public function show(Tip $tip): RedirectResponse
    {
        $tip->togglePublish();

        return redirect()->route('admin.dashboard');
    }
}
