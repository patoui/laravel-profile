<?php

namespace App\Http\Controllers;

use Exception;
use Twilio\Rest\Client;
use Illuminate\Http\Request;

class SmsController extends Controller
{
    public function index()
    {
        return view('sms.index');
    }

    public function store(Request $request)
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
        } catch (Exception $e) {
            return redirect()->route('sms.index')
                ->with('error', $e->getMessage());
        }
    }
}
