<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $pendingPayments = Payment::with('rental.vehicle', 'rental.user')
            ->where('status', 'pending')
            ->latest()
            ->paginate(15);

        $recentPaid = Payment::with('rental.vehicle', 'rental.user')
            ->where('status', 'paid')
            ->latest()
            ->take(5)
            ->get();

        return view('staff.payments.index', compact('pendingPayments', 'recentPaid'));
    }

    public function confirm(Request $request, Payment $payment)
    {
        $request->validate([
            'method' => 'required|in:cash,transfer',
        ]);

        $payment->update([
            'status' => 'paid',
            'method' => $request->method,
            'paid_at' => now(),
        ]);

        return redirect()->route('staff.payments.index')
            ->with('success', 'Pembayaran berhasil dikonfirmasi.');
    }

    public function receipt(Payment $payment)
    {
        $payment->load('rental.vehicle', 'rental.user');
        return view('staff.payments.receipt', compact('payment'));
    }
}
