<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessCovid19;
use Illuminate\Http\JsonResponse;

class Covid19WebhookController extends Controller
{
    public function index(): JsonResponse
    {
        ProcessCovid19::dispatch();
        return new JsonResponse('Successfully triggered');
    }
}
