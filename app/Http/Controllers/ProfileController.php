<?php

namespace App\Http\Controllers;

use App\User;

class ProfileController extends Controller
{
    public function show(User $profile)
    {
        return view('profile.show')
            ->with('user', $profile)
            ->with('activities', $profile->activities()->get());
    }
}
