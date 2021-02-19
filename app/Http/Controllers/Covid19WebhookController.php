<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

class Covid19WebhookController extends Controller
{
    public function index(): JsonResponse
    {
        return new JsonResponse(null, 204);
    }
}
