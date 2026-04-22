<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Rental;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $monthlyRevenue = Payment::where('status', 'paid')
            ->whereMonth('paid_at', now()->month)
            ->whereYear('paid_at', now()->year)
            ->sum('amount');

        $activeRentals = Rental::whereIn('status', ['confirmed', 'ongoing'])->count();

        $vehicleStats = Vehicle::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status');

        $dailyRevenue = Payment::where('status', 'paid')
            ->where('paid_at', '>=', now()->subDays(6))
            ->selectRaw('DATE(paid_at) as date, SUM(amount) as total')
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->keyBy('date');

        $last7Days = collect();
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->toDateString();
            $last7Days[$date] = $dailyRevenue->get($date)?->total ?? 0;
        }

        $totalCustomers = User::where('role', 'pelanggan')->count();

        return view('admin.dashboard', compact(
            'monthlyRevenue', 'activeRentals', 'vehicleStats', 'last7Days', 'totalCustomers'
        ));
    }
}
