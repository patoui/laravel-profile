<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\User;
use Illuminate\View\View;
use function view;

class ProfileController extends Controller
{
    public function show(User $profile): View
    {
        return view('profile.show')
            ->with('user', $profile)
            ->with('activities', $profile->activities()->get());
    }
}
