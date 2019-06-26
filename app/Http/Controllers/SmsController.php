<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Throwable;
use Twilio\Rest\Client;
use function config;
use function redirect;
use function view;

class SmsController extends Controller
{
    public function index() : View
    {
        return view('sms.index');
    }

    public function store(Request $request) : RedirectResponse
    {
        $this->validate($request, ['message' => 'required|string|max:140']);

        $client = new Client(config('twilio.account'), config('twilio.token'));

        try {
            $client->messages->create('+19059220633', [
                'from' => config('twilio.phone'),
                'body' => $request->input('message'),
            ]);

            return redirect()->route('sms.index')
                ->with('success', 'Your message was sent successfully!');
        } catch (Throwable $e) {
            return redirect()->route('sms.index')
                ->with('error', $e->getMessage());
        }
    }
}
