<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::withTrashed()->withCount('rentals')->latest()->paginate(15);
        return view('admin.vehicles.index', compact('vehicles'));
    }

    public function create()
    {
        return view('admin.vehicles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:100',
            'type' => 'required|in:motor,mobil',
            'year' => 'required|integer|min:1990|max:' . (date('Y') + 1),
            'plate_number' => 'required|string|unique:vehicles,plate_number',
            'price_per_day' => 'required|numeric|min:1000',
            'fuel_type' => 'required|string|max:50',
            'transmission' => 'required|in:manual,automatic',
            'capacity' => 'required|integer|min:1',
            'description' => 'nullable|string',
            'image_url' => 'nullable|url',
            'status' => 'required|in:available,rented,maintenance',
        ]);

        Vehicle::create($request->all());

        return redirect()->route('admin.vehicles.index')
            ->with('success', 'Kendaraan berhasil ditambahkan.');
    }

    public function show(Vehicle $vehicle)
    {
        $vehicle->load(['rentals' => function ($q) {
            $q->with('user')->latest()->take(10);
        }]);
        return view('admin.vehicles.show', compact('vehicle'));
    }

    public function edit(Vehicle $vehicle)
    {
        return view('admin.vehicles.edit', compact('vehicle'));
    }

    public function update(Request $request, Vehicle $vehicle)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:100',
            'type' => 'required|in:motor,mobil',
            'year' => 'required|integer|min:1990|max:' . (date('Y') + 1),
            'plate_number' => 'required|string|unique:vehicles,plate_number,' . $vehicle->id,
            'price_per_day' => 'required|numeric|min:1000',
            'fuel_type' => 'required|string|max:50',
            'transmission' => 'required|in:manual,automatic',
            'capacity' => 'required|integer|min:1',
            'description' => 'nullable|string',
            'image_url' => 'nullable|url',
            'status' => 'required|in:available,rented,maintenance',
        ]);

        $vehicle->update($request->all());

        return redirect()->route('admin.vehicles.index')
            ->with('success', 'Data kendaraan berhasil diperbarui.');
    }

    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();
        return redirect()->route('admin.vehicles.index')
            ->with('success', 'Kendaraan berhasil dihapus.');
    }
}
