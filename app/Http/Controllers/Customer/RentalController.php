<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Rental;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class RentalController extends Controller
{
    public function index()
    {
        $rentals = auth()->user()->rentals()
            ->with('vehicle', 'payment')
            ->latest()
            ->paginate(10);

        return view('customer.rentals.index', compact('rentals'));
    }

    public function create(Request $request)
    {
        $vehicle = null;
        if ($request->filled('vehicle_id')) {
            $vehicle = Vehicle::findOrFail($request->vehicle_id);
        }

        $vehicles = Vehicle::where('status', 'available')->orderBy('type')->orderBy('name')->get();

        return view('customer.rentals.create', compact('vehicle', 'vehicles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
            'notes' => 'nullable|string|max:500',
        ]);

        $vehicle = Vehicle::findOrFail($request->vehicle_id);

        if (!$vehicle->isAvailableOn($request->start_date, $request->end_date)) {
            return back()->withInput()->with('error', 'Kendaraan sudah dipesan pada tanggal tersebut. Silakan pilih tanggal lain.');
        }

        $totalDays = \Carbon\Carbon::parse($request->start_date)->diffInDays(\Carbon\Carbon::parse($request->end_date));
        $totalPrice = $totalDays * $vehicle->price_per_day;
        $deposit = min($totalPrice * 0.3, 500000);

        $rental = Rental::create([
            'user_id' => auth()->id(),
            'vehicle_id' => $vehicle->id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'total_days' => $totalDays,
            'total_price' => $totalPrice,
            'deposit' => $deposit,
            'status' => 'pending',
            'notes' => $request->notes,
        ]);

        Payment::create([
            'rental_id' => $rental->id,
            'amount' => $totalPrice,
            'method' => 'cash',
            'status' => 'pending',
        ]);

        return redirect()->route('customer.rentals.show', $rental)
            ->with('success', 'Pemesanan berhasil! Menunggu konfirmasi dari staff kami.');
    }

    public function show(Rental $rental)
    {
        if ($rental->user_id !== auth()->id()) {
            abort(403);
        }

        $rental->load('vehicle', 'payment', 'extensions', 'damages', 'staff');

        return view('customer.rentals.show', compact('rental'));
    }

    public function destroy(Rental $rental)
    {
        if ($rental->user_id !== auth()->id()) {
            abort(403);
        }

        if ($rental->status !== 'pending') {
            return back()->with('error', 'Hanya rental dengan status "Menunggu" yang dapat dibatalkan.');
        }

        $rental->update(['status' => 'cancelled']);

        return redirect()->route('customer.rentals.index')
            ->with('success', 'Rental berhasil dibatalkan.');
    }
}
