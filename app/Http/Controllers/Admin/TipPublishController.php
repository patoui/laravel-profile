<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Repositories\TipRepository;
use App\Tip;
use Illuminate\Http\RedirectResponse;

use function redirect;

final class TipPublishController
{
    public function show(Tip $tip, TipRepository $tipRepository): RedirectResponse
    {
        $tipRepository->togglePublish($tip);

        return redirect()->route('admin.dashboard');
    }
}
