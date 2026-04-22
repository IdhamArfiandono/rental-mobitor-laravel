<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Damage;
use App\Models\Rental;
use App\Models\RentalExtension;
use Illuminate\Http\Request;

class RentalController extends Controller
{
    public function index(Request $request)
    {
        $query = Rental::with('vehicle', 'user', 'payment')->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('date')) {
            $query->whereDate('start_date', $request->date);
        }

        $rentals = $query->paginate(15)->withQueryString();

        return view('staff.rentals.index', compact('rentals'));
    }

    public function show(Rental $rental)
    {
        $rental->load('vehicle', 'user', 'payment', 'extensions', 'damages', 'staff');
        return view('staff.rentals.show', compact('rental'));
    }

    public function edit(Rental $rental)
    {
        return view('staff.rentals.edit', compact('rental'));
    }

    public function update(Request $request, Rental $rental)
    {
        $request->validate([
            'status' => 'required|in:confirmed,ongoing,completed,cancelled',
        ]);

        $oldStatus = $rental->status;
        $newStatus = $request->status;

        $rental->update([
            'status' => $newStatus,
            'staff_id' => auth()->id(),
        ]);

        if ($newStatus === 'ongoing' && $oldStatus === 'confirmed') {
            $rental->vehicle->update(['status' => 'rented']);
        }

        if ($newStatus === 'completed') {
            $rental->vehicle->update(['status' => 'available']);
        }

        if ($newStatus === 'cancelled') {
            if (in_array($oldStatus, ['ongoing'])) {
                $rental->vehicle->update(['status' => 'available']);
            }
        }

        return redirect()->route('staff.rentals.show', $rental)
            ->with('success', 'Status rental berhasil diperbarui.');
    }

    public function extend(Request $request, Rental $rental)
    {
        $request->validate([
            'extended_days' => 'required|integer|min:1',
            'reason' => 'nullable|string|max:500',
        ]);

        $additionalCost = $request->extended_days * $rental->vehicle->price_per_day;

        RentalExtension::create([
            'rental_id' => $rental->id,
            'extended_days' => $request->extended_days,
            'additional_cost' => $additionalCost,
            'reason' => $request->reason,
        ]);

        $newEndDate = \Carbon\Carbon::parse($rental->end_date)->addDays($request->extended_days);
        $rental->update([
            'end_date' => $newEndDate,
            'total_days' => $rental->total_days + $request->extended_days,
            'total_price' => $rental->total_price + $additionalCost,
        ]);

        if ($rental->payment) {
            $rental->payment->update(['amount' => $rental->total_price]);
        }

        return redirect()->route('staff.rentals.show', $rental)
            ->with('success', "Perpanjangan {$request->extended_days} hari berhasil ditambahkan.");
    }

    public function damage(Request $request, Rental $rental)
    {
        $request->validate([
            'description' => 'required|string|max:1000',
            'repair_cost' => 'required|numeric|min:0',
        ]);

        Damage::create([
            'rental_id' => $rental->id,
            'description' => $request->description,
            'repair_cost' => $request->repair_cost,
        ]);

        return redirect()->route('staff.rentals.show', $rental)
            ->with('success', 'Catatan kerusakan berhasil disimpan.');
    }
}
