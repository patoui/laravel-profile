<?php

namespace App\Http\Controllers;

use App\Subscription;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    /**
     * Store a subscription.
     *
     * @return Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        $this->validate(
            request(),
            ['subscription_email' => 'required|email']
        );

        Subscription::firstOrCreate(['email' => request('subscription_email')]);

        flash('Thank you for subscribing! Stay tuned, more to come!');

        return redirect()->route('home');
    }
}
