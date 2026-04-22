<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Damage;
use App\Models\Payment;
use App\Models\Rental;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $year = $request->get('year', now()->year);
        $month = $request->get('month', now()->month);

        $monthlyRevenue = Payment::where('status', 'paid')
            ->whereYear('paid_at', $year)
            ->selectRaw('MONTH(paid_at) as month, SUM(amount) as total, COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->keyBy('month');

        $popularVehicles = Vehicle::withCount(['rentals as completed_rentals' => function ($q) use ($year) {
            $q->where('status', 'completed')->whereYear('created_at', $year);
        }])->orderByDesc('completed_rentals')->take(5)->get();

        $selectedMonthRevenue = Payment::where('status', 'paid')
            ->whereYear('paid_at', $year)
            ->whereMonth('paid_at', $month)
            ->sum('amount');

        $selectedMonthRentals = Rental::whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->count();

        $recentDamages = Damage::with('rental.vehicle', 'rental.user')
            ->latest()
            ->take(10)
            ->get();

        $totalDamagesCost = Damage::whereYear('created_at', $year)->sum('repair_cost');

        return view('admin.reports.index', compact(
            'monthlyRevenue', 'popularVehicles', 'year', 'month',
            'selectedMonthRevenue', 'selectedMonthRentals', 'recentDamages', 'totalDamagesCost'
        ));
    }
}
