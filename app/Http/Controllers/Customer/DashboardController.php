<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $ongoing = $user->rentals()
            ->with('vehicle')
            ->where('status', 'ongoing')
            ->latest()
            ->get();

        $confirmed = $user->rentals()
            ->with('vehicle')
            ->where('status', 'confirmed')
            ->latest()
            ->get();

        $recent = $user->rentals()
            ->with('vehicle')
            ->whereIn('status', ['completed', 'cancelled'])
            ->latest()
            ->take(5)
            ->get();

        return view('customer.dashboard', compact('ongoing', 'confirmed', 'recent'));
    }
}
