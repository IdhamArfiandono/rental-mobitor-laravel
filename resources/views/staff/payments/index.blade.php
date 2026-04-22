<x-dashboard-layout>
    <x-slot name="title">Kelola Pembayaran</x-slot>

    <!-- Pembayaran Pending -->
    <div class="mb-8">
        <h3 class="text-lg font-bold text-secondary mb-4">Menunggu Konfirmasi ({{ $pendingPayments->total() }})</h3>
        <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
            @forelse($pendingPayments as $payment)
                <div class="flex items-center gap-4 p-4 border-b border-gray-50 last:border-0" x-data="{ open: false }">
                    <div class="flex-1">
                        <div class="flex items-center gap-2 mb-1">
                            <p class="font-semibold text-gray-800">{{ $payment->rental->user->name }}</p>
                            <span class="text-gray-400 text-xs">&bull; Rental #{{ $payment->rental_id }}</span>
                        </div>
                        <p class="text-sm text-gray-600">{{ $payment->rental->vehicle->name }}</p>
                        <p class="text-sm text-gray-500">{{ $payment->rental->start_date->format('d M') }} - {{ $payment->rental->end_date->format('d M Y') }}</p>
                        <p class="font-bold text-primary">Rp {{ number_format($payment->amount, 0, ',', '.') }}</p>
                    </div>
                    <div class="flex flex-col items-end gap-2">
                        <button @click="open = !open" class="bg-green-600 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-green-700 transition-colors">
                            Konfirmasi
                        </button>
                        <a href="{{ route('staff.rentals.show', $payment->rental) }}" class="text-primary text-xs hover:underline">Detail Rental</a>
                    </div>

                    <!-- Modal Konfirmasi -->
                    <div x-show="open" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4" @click.self="open = false">
                        <div class="bg-white rounded-2xl p-6 max-w-sm w-full">
                            <h4 class="font-bold text-secondary text-lg mb-4">Konfirmasi Pembayaran</h4>
                            <p class="text-gray-600 text-sm mb-4">
                                Konfirmasi pembayaran <strong>Rp {{ number_format($payment->amount, 0, ',', '.') }}</strong> dari <strong>{{ $payment->rental->user->name }}</strong>
                            </p>
                            <form method="POST" action="{{ route('staff.payments.confirm', $payment) }}">
                                @csrf
                                <div class="mb-4">
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Metode Pembayaran</label>
                                    <select name="method" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-primary">
                                        <option value="cash">Tunai (Cash)</option>
                                        <option value="transfer">Transfer Bank</option>
                                    </select>
                                </div>
                                <div class="flex gap-3">
                                    <button type="button" @click="open = false" class="flex-1 border border-gray-200 text-gray-600 py-2.5 rounded-xl text-sm font-semibold hover:bg-gray-50">Batal</button>
                                    <button type="submit" class="flex-1 bg-green-600 text-white py-2.5 rounded-xl text-sm font-semibold hover:bg-green-700">Konfirmasi</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-10 text-gray-400">
                    <p>Tidak ada pembayaran yang menunggu konfirmasi</p>
                </div>
            @endforelse
        </div>
        @if($pendingPayments->hasPages())
            <div class="mt-4">{{ $pendingPayments->links() }}</div>
        @endif
    </div>

    <!-- Pembayaran Terkonfirmasi -->
    @if($recentPaid->count() > 0)
        <div>
            <h3 class="text-lg font-bold text-secondary mb-4">Terakhir Dikonfirmasi</h3>
            <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
                @foreach($recentPaid as $payment)
                    <div class="flex items-center gap-4 p-4 border-b border-gray-50 last:border-0">
                        <div class="flex-1">
                            <p class="font-semibold text-gray-800">{{ $payment->rental->user->name }}</p>
                            <p class="text-sm text-gray-600">{{ $payment->rental->vehicle->name }}</p>
                            <p class="font-bold text-green-600">Rp {{ number_format($payment->amount, 0, ',', '.') }}</p>
                        </div>
                        <div class="text-right">
                            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">Lunas</span>
                            <p class="text-xs text-gray-400 mt-1">{{ ucfirst($payment->method) }}</p>
                            <p class="text-xs text-gray-400">{{ $payment->paid_at?->format('d M Y H:i') }}</p>
                        </div>
                        <a href="{{ route('staff.payments.receipt', $payment) }}"
                           class="text-primary text-sm hover:underline font-medium">Kwitansi</a>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</x-dashboard-layout>
