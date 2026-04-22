<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;

class VehicleDetailController extends Controller
{
    public function show(Vehicle $vehicle)
    {
        $similar = Vehicle::where('type', $vehicle->type)
            ->where('status', 'available')
            ->where('id', '!=', $vehicle->id)
            ->take(3)
            ->get();

        return view('public.vehicle-detail', compact('vehicle', 'similar'));
    }
}
