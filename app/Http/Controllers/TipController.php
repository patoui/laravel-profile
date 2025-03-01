<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Analytic;
use App\Repositories\TipRepository;
use App\Tip;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\View\View;

final class TipController
{
    public function index(Request $request, TipRepository $tipRepository): View
    {
        $tip = $tipRepository->latestPublished(
            $request->input('tag') ? Arr::wrap($request->input('tag')) : null
        );

        return view('tip.index', ['tips' => $tip]);
    }

    public function show(Request $request, Tip $tip, TipRepository $tipRepository): View
    {
        Analytic::process($request, $tip);

        return view('tip.show', ['tip' => $tip, 'previousTip' => $tipRepository->previousPublished($tip), 'nextTip' => $tipRepository->nextPublished($tip)]);
    }
}
