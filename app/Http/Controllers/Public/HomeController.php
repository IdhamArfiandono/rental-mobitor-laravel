<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;

class HomeController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::where('status', 'available')
            ->latest()
            ->take(6)
            ->get();

        return view('public.home', compact('vehicles'));
    }
}
