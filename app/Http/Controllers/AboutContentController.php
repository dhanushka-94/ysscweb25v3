<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutContentController extends Controller
{
    public function history()
    {
        return view('about.history');
    }

    public function club()
    {
        return view('about.club');
    }

    public function arena()
    {
        return view('about.arena');
    }

    public function bankDetails()
    {
        return view('about.bank-details');
    }
}
