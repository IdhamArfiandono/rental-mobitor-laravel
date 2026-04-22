<x-dashboard-layout>
    <x-slot name="title">Detail Rental #{{ $rental->id }}</x-slot>

    @php
        $statusColor = match($rental->status) {
            'pending' => 'bg-yellow-100 text-yellow-700 border-yellow-200',
            'confirmed' => 'bg-blue-100 text-blue-700 border-blue-200',
            'ongoing' => 'bg-green-100 text-green-700 border-green-200',
            'completed' => 'bg-gray-100 text-gray-600 border-gray-200',
            'cancelled' => 'bg-red-100 text-red-700 border-red-200',
            default => 'bg-gray-100 text-gray-700 border-gray-200',
        };
        $statusLabel = match($rental->status) {
            'pending' => 'Menunggu Konfirmasi',
            'confirmed' => 'Dikonfirmasi',
            'ongoing' => 'Sedang Berlangsung',
            'completed' => 'Selesai',
            'cancelled' => 'Dibatalkan',
            default => ucfirst($rental->status),
        };
    @endphp

    <div class="mb-4">
        <a href="{{ route('customer.rentals.index') }}" class="inline-flex items-center gap-2 text-gray-500 hover:text-primary text-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Kembali
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Info Utama -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Status Banner -->
            <div class="border {{ $statusColor }} rounded-2xl p-4 flex items-center gap-3">
                <div class="w-10 h-10 rounded-full flex items-center justify-center {{ $statusColor }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <p class="font-bold">{{ $statusLabel }}</p>
                    <p class="text-sm opacity-75">Rental #{{ $rental->id }} &bull; Dibuat {{ $rental->created_at->format('d M Y H:i') }}</p>
                </div>
            </div>

            <!-- Kendaraan -->
            <div class="bg-white rounded-2xl border border-gray-100 p-6">
                <h3 class="font-bold text-secondary mb-4">Kendaraan</h3>
                <div class="flex gap-4">
                    <div class="w-24 h-20 rounded-xl overflow-hidden bg-gray-100 flex-shrink-0">
                        <img src="{{ $rental->vehicle->image_url ?? '' }}" alt="{{ $rental->vehicle->name }}" class="w-full h-full object-cover">
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-800 text-lg">{{ $rental->vehicle->name }}</h4>
                        <p class="text-gray-500">{{ $rental->vehicle->brand }} {{ $rental->vehicle->year }}</p>
                        <p class="text-gray-500 text-sm">Plat: {{ $rental->vehicle->plate_number }}</p>
                    </div>
                </div>
            </div>

            <!-- Detail Rental -->
            <div class="bg-white rounded-2xl border border-gray-100 p-6">
                <h3 class="font-bold text-secondary mb-4">Detail Pemesanan</h3>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-gray-500 text-sm">Tanggal Mulai</p>
                        <p class="font-semibold text-gray-800">{{ $rental->start_date->format('d M Y') }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Tanggal Selesai</p>
                        <p class="font-semibold text-gray-800">{{ $rental->end_date->format('d M Y') }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Total Hari</p>
                        <p class="font-semibold text-gray-800">{{ $rental->total_days }} hari</p>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Harga/Hari</p>
                        <p class="font-semibold text-gray-800">Rp {{ number_format($rental->vehicle->price_per_day, 0, ',', '.') }}</p>
                    </div>
                </div>
                @if($rental->notes)
                    <div class="mt-4 pt-4 border-t border-gray-100">
                        <p class="text-gray-500 text-sm">Catatan</p>
                        <p class="text-gray-800 mt-1">{{ $rental->notes }}</p>
                    </div>
                @endif
                @if($rental->staff)
                    <div class="mt-4 pt-4 border-t border-gray-100">
                        <p class="text-gray-500 text-sm">Diproses oleh</p>
                        <p class="font-semibold text-gray-800">{{ $rental->staff->name }}</p>
                    </div>
                @endif
            </div>

            <!-- Perpanjangan -->
            @if($rental->extensions->count() > 0)
                <div class="bg-white rounded-2xl border border-gray-100 p-6">
                    <h3 class="font-bold text-secondary mb-4">Perpanjangan Rental</h3>
                    @foreach($rental->extensions as $ext)
                        <div class="flex justify-between items-center py-2 border-b border-gray-50 last:border-0">
                            <div>
                                <p class="font-medium text-gray-800">+{{ $ext->extended_days }} hari</p>
                                @if($ext->reason)<p class="text-sm text-gray-500">{{ $ext->reason }}</p>@endif
                            </div>
                            <p class="font-semibold text-primary">+Rp {{ number_format($ext->additional_cost, 0, ',', '.') }}</p>
                        </div>
                    @endforeach
                </div>
            @endif

            <!-- Kerusakan -->
            @if($rental->damages->count() > 0)
                <div class="bg-white rounded-2xl border border-red-100 p-6">
                    <h3 class="font-bold text-red-700 mb-4">Catatan Kerusakan</h3>
                    @foreach($rental->damages as $damage)
                        <div class="flex justify-between items-start py-2 border-b border-red-50 last:border-0">
                            <p class="text-gray-800 flex-1 pr-4">{{ $damage->description }}</p>
                            <p class="font-semibold text-red-600 flex-shrink-0">Rp {{ number_format($damage->repair_cost, 0, ',', '.') }}</p>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Pembayaran -->
            <div class="bg-white rounded-2xl border border-gray-100 p-6">
                <h3 class="font-bold text-secondary mb-4">Pembayaran</h3>
                <div class="space-y-3 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-500">Total Harga</span>
                        <span class="font-semibold">Rp {{ number_format($rental->total_price, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Deposit</span>
                        <span class="font-semibold text-orange-600">Rp {{ number_format($rental->deposit, 0, ',', '.') }}</span>
                    </div>
                    @if($rental->extensions->count() > 0)
                        <div class="flex justify-between">
                            <span class="text-gray-500">Biaya Perpanjangan</span>
                            <span class="font-semibold">Rp {{ number_format($rental->extensions->sum('additional_cost'), 0, ',', '.') }}</span>
                        </div>
                    @endif
                    <div class="border-t border-gray-100 pt-3 flex justify-between">
                        <span class="font-bold text-gray-800">Total Bayar</span>
                        <span class="font-extrabold text-primary">Rp {{ number_format($rental->total_price + $rental->extensions->sum('additional_cost'), 0, ',', '.') }}</span>
                    </div>
                </div>

                @if($rental->payment)
                    <div class="mt-4 pt-4 border-t border-gray-100">
                        <div class="flex items-center justify-between">
                            <span class="text-gray-500 text-sm">Status Pembayaran</span>
                            <span class="px-3 py-1 rounded-full text-xs font-semibold
                                {{ $rental->payment->status === 'paid' ? 'bg-green-100 text-green-700' : 'bg-orange-100 text-orange-700' }}">
                                {{ $rental->payment->status === 'paid' ? 'Lunas' : 'Belum Bayar' }}
                            </span>
                        </div>
                        @if($rental->payment->paid_at)
                            <p class="text-xs text-gray-400 mt-2">Dibayar {{ $rental->payment->paid_at->format('d M Y H:i') }}</p>
                        @endif
                    </div>
                @endif
            </div>

            <!-- Aksi -->
            @if($rental->status === 'pending')
                <div class="bg-white rounded-2xl border border-gray-100 p-6">
                    <h3 class="font-bold text-secondary mb-4">Aksi</h3>
                    <form method="POST" action="{{ route('customer.rentals.destroy', $rental) }}"
                          onsubmit="return confirm('Apakah Anda yakin ingin membatalkan rental ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full bg-red-500 text-white font-semibold py-2.5 rounded-xl hover:bg-red-600 transition-colors text-sm">
                            Batalkan Rental
                        </button>
                    </form>
                    <p class="text-xs text-gray-400 mt-2 text-center">Pembatalan hanya bisa dilakukan sebelum dikonfirmasi</p>
                </div>
            @endif
        </div>
    </div>
</x-dashboard-layout>
