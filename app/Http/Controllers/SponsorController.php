<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sponsor;

class SponsorController extends Controller
{
    public function index()
    {
        $sponsors = Sponsor::where('is_active', true)
            ->orderBy('tier')
            ->orderBy('order')
            ->get()
            ->groupBy('tier');
        
        return view('sponsors.index', compact('sponsors'));
    }
}
