<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::withCount(['rentals as active_rentals_count' => function ($q) {
            $q->whereIn('status', ['ongoing', 'confirmed']);
        }])->orderBy('status')->orderBy('name')->paginate(20);

        return view('staff.vehicles.index', compact('vehicles'));
    }

    public function updateStatus(Request $request, Vehicle $vehicle)
    {
        $request->validate([
            'status' => 'required|in:available,rented,maintenance',
        ]);

        $vehicle->update(['status' => $request->status]);

        return back()->with('success', 'Status kendaraan berhasil diperbarui.');
    }
}
