<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\View\View;
use function view;

class HomeController extends Controller
{
    public function index(): View
    {
        return view('home');
    }
}
