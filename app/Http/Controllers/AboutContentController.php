<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutContentController extends Controller
{
    public function history()
    {
        $breadcrumbs = [
            ['title' => 'Home', 'url' => route('home')],
            ['title' => 'About', 'url' => null],
            ['title' => 'Our History', 'url' => null]
        ];
        
        return view('about.history', compact('breadcrumbs'));
    }

    public function club()
    {
        $breadcrumbs = [
            ['title' => 'Home', 'url' => route('home')],
            ['title' => 'About', 'url' => null],
            ['title' => 'The Club', 'url' => null]
        ];
        
        return view('about.club', compact('breadcrumbs'));
    }

    public function arena()
    {
        $breadcrumbs = [
            ['title' => 'Home', 'url' => route('home')],
            ['title' => 'About', 'url' => null],
            ['title' => 'Arena', 'url' => null]
        ];
        
        return view('about.arena', compact('breadcrumbs'));
    }

    public function bankDetails()
    {
        $breadcrumbs = [
            ['title' => 'Home', 'url' => route('home')],
            ['title' => 'About', 'url' => null],
            ['title' => 'Bank Details', 'url' => null]
        ];
        
        return view('about.bank-details', compact('breadcrumbs'));
    }
}
