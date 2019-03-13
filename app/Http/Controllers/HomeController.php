<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    /**
     * Show home page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
}
