<x-dashboard-layout>
    <x-slot name="title">Riwayat Rental</x-slot>

    <div class="flex items-center justify-between mb-6">
        <h2 class="text-xl font-bold text-secondary">Semua Rental</h2>
        <a href="{{ route('catalog.index') }}"
           class="inline-flex items-center gap-2 bg-primary text-white font-semibold px-4 py-2 rounded-lg text-sm hover:bg-blue-700 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Sewa Baru
        </a>
    </div>

    @if($rentals->count() > 0)
        <div class="space-y-3 mb-6">
            @foreach($rentals as $rental)
                <a href="{{ route('customer.rentals.show', $rental) }}" class="block">
                    @php
                        $statusColor = match($rental->status) {
                            'pending' => 'bg-yellow-100 text-yellow-700',
                            'confirmed' => 'bg-blue-100 text-blue-700',
                            'ongoing' => 'bg-green-100 text-green-700',
                            'completed' => 'bg-gray-100 text-gray-600',
                            'cancelled' => 'bg-red-100 text-red-700',
                            default => 'bg-gray-100 text-gray-700',
                        };
                        $statusLabel = match($rental->status) {
                            'pending' => 'Menunggu',
                            'confirmed' => 'Dikonfirmasi',
                            'ongoing' => 'Berlangsung',
                            'completed' => 'Selesai',
                            'cancelled' => 'Dibatalkan',
                            default => ucfirst($rental->status),
                        };
                    @endphp
                    <div class="bg-white rounded-xl border border-gray-100 p-4 hover:shadow-sm transition-shadow">
                        <div class="flex items-center gap-4">
                            <div class="w-16 h-16 rounded-lg overflow-hidden bg-gray-100 flex-shrink-0">
                                <img src="{{ $rental->vehicle->image_url ?? '' }}" alt="{{ $rental->vehicle->name }}" class="w-full h-full object-cover">
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-start justify-between gap-2">
                                    <div>
                                        <h4 class="font-semibold text-gray-800">{{ $rental->vehicle->name }}</h4>
                                        <p class="text-sm text-gray-500">{{ $rental->start_date->format('d M Y') }} - {{ $rental->end_date->format('d M Y') }}</p>
                                        <p class="text-sm text-gray-500">{{ $rental->total_days }} hari &bull; Rp {{ number_format($rental->total_price, 0, ',', '.') }}</p>
                                    </div>
                                    <div class="flex flex-col items-end gap-2">
                                        <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $statusColor }}">{{ $statusLabel }}</span>
                                        @if($rental->payment)
                                            <span class="px-2 py-0.5 rounded-full text-xs font-medium
                                                {{ $rental->payment->status === 'paid' ? 'bg-green-100 text-green-700' : 'bg-orange-100 text-orange-700' }}">
                                                {{ $rental->payment->status === 'paid' ? 'Lunas' : 'Belum Bayar' }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
        {{ $rentals->links() }}
    @else
        <div class="bg-white rounded-2xl border border-gray-100 p-10 text-center">
            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
            </div>
            <h3 class="font-semibold text-gray-700 mb-2">Belum Ada Rental</h3>
            <p class="text-gray-500 text-sm mb-4">Anda belum pernah melakukan pemesanan rental.</p>
            <a href="{{ route('catalog.index') }}" class="inline-block bg-primary text-white font-semibold px-5 py-2.5 rounded-lg text-sm hover:bg-blue-700 transition-colors">
                Sewa Kendaraan
            </a>
        </div>
    @endif
</x-dashboard-layout>
