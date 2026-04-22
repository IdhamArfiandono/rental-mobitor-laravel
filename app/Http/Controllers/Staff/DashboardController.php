<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Rental;
use App\Models\Vehicle;

class DashboardController extends Controller
{
    public function index()
    {
        $today = now()->toDateString();

        $startingToday = Rental::with('vehicle', 'user')
            ->where('start_date', $today)
            ->whereIn('status', ['confirmed', 'ongoing'])
            ->get();

        $returningToday = Rental::with('vehicle', 'user')
            ->where('end_date', $today)
            ->where('status', 'ongoing')
            ->get();

        $maintenance = Vehicle::where('status', 'maintenance')->get();

        $pendingRentals = Rental::with('vehicle', 'user')
            ->where('status', 'pending')
            ->latest()
            ->take(5)
            ->get();

        return view('staff.dashboard', compact('startingToday', 'returningToday', 'maintenance', 'pendingRentals'));
    }
}
