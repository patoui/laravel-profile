<?php

namespace App\Http\Controllers;

use App\Subscription;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class SubscriptionController extends Controller
{
    public function store(Request $request) : RedirectResponse
    {
        $this->validate($request, ['subscription_email' => 'required|email']);

        Subscription::firstOrCreate([
            'email' => $request->input('subscription_email')
        ]);

        flash('Thank you for subscribing! Stay tuned, more to come!');

        return redirect()->route('home');
    }
}
