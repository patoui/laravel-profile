<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use function view;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index() : View
    {
        return view('home');
    }
}
