<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessCovid19;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;

class Covid19WebhookController extends Controller
{
    public function index(): JsonResponse
    {
        Cache::put('webhook_triggered', ['timestamp' => Carbon::now()->toIso8601String()]);
        ProcessCovid19::dispatch();
        return new JsonResponse('Successfully triggered');
    }
}
