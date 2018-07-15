<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show(User $profile)
    {
        return view('profile.show')
            ->with('user', auth()->user())
            ->with('activities', auth()->user()->activities()->get());
    }
}
