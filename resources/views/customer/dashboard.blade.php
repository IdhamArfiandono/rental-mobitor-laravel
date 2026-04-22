<x-dashboard-layout>
    <x-slot name="title">Dashboard Pelanggan</x-slot>

    <!-- Welcome -->
    <div class="bg-gradient-to-r from-secondary to-primary rounded-2xl p-6 text-white mb-6">
        <h2 class="text-2xl font-bold mb-1">Halo, {{ auth()->user()->name }}!</h2>
        <p class="text-blue-200">Selamat datang kembali di Rental Mobitor.</p>
        <a href="{{ route('catalog.index') }}"
           class="inline-block mt-4 bg-accent text-secondary font-bold px-5 py-2 rounded-lg text-sm hover:bg-yellow-400 transition-colors">
            Sewa Kendaraan Baru
        </a>
    </div>

    <!-- Rental Aktif -->
    @if($ongoing->count() > 0)
        <div class="mb-6">
            <h3 class="text-lg font-bold text-secondary mb-3">Rental Sedang Berlangsung</h3>
            <div class="space-y-3">
                @foreach($ongoing as $rental)
                    <a href="{{ route('customer.rentals.show', $rental) }}" class="block">
                        <div class="bg-green-50 border border-green-200 rounded-xl p-4 flex items-center gap-4 hover:shadow-sm transition-shadow">
                            <div class="w-14 h-14 rounded-lg overflow-hidden bg-gray-100 flex-shrink-0">
                                <img src="{{ $rental->vehicle->image_url ?? '' }}" alt="{{ $rental->vehicle->name }}" class="w-full h-full object-cover">
                            </div>
                            <div class="flex-1">
                                <p class="font-semibold text-gray-800">{{ $rental->vehicle->name }}</p>
                                <p class="text-sm text-gray-500">{{ $rental->start_date->format('d M') }} - {{ $rental->end_date->format('d M Y') }}</p>
                                <p class="text-sm font-bold text-green-600">Berlangsung &bull; Kembali {{ $rental->end_date->diffForHumans() }}</p>
                            </div>
                            <svg class="w-5 h-5 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Rental Mendatang -->
    @if($confirmed->count() > 0)
        <div class="mb-6">
            <h3 class="text-lg font-bold text-secondary mb-3">Rental Mendatang</h3>
            <div class="space-y-3">
                @foreach($confirmed as $rental)
                    <a href="{{ route('customer.rentals.show', $rental) }}" class="block">
                        <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 flex items-center gap-4 hover:shadow-sm transition-shadow">
                            <div class="w-14 h-14 rounded-lg overflow-hidden bg-gray-100 flex-shrink-0">
                                <img src="{{ $rental->vehicle->image_url ?? '' }}" alt="{{ $rental->vehicle->name }}" class="w-full h-full object-cover">
                            </div>
                            <div class="flex-1">
                                <p class="font-semibold text-gray-800">{{ $rental->vehicle->name }}</p>
                                <p class="text-sm text-gray-500">{{ $rental->start_date->format('d M') }} - {{ $rental->end_date->format('d M Y') }}</p>
                                <p class="text-sm font-bold text-blue-600">Dikonfirmasi &bull; Mulai {{ $rental->start_date->diffForHumans() }}</p>
                            </div>
                            <svg class="w-5 h-5 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    @endif

    @if($ongoing->count() === 0 && $confirmed->count() === 0)
        <div class="bg-white rounded-2xl border border-gray-100 p-10 text-center mb-6">
            <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
            </div>
            <h3 class="font-semibold text-gray-700 mb-2">Belum Ada Rental Aktif</h3>
            <p class="text-gray-500 text-sm mb-4">Anda belum memiliki rental yang sedang berlangsung.</p>
            <a href="{{ route('catalog.index') }}" class="inline-block bg-primary text-white font-semibold px-5 py-2.5 rounded-lg hover:bg-blue-700 transition-colors text-sm">
                Sewa Kendaraan
            </a>
        </div>
    @endif

    <!-- Riwayat -->
    @if($recent->count() > 0)
        <div>
            <div class="flex items-center justify-between mb-3">
                <h3 class="text-lg font-bold text-secondary">Riwayat Terakhir</h3>
                <a href="{{ route('customer.rentals.index') }}" class="text-primary text-sm font-medium hover:underline">Lihat Semua</a>
            </div>
            <div class="space-y-3">
                @foreach($recent as $rental)
                    <a href="{{ route('customer.rentals.show', $rental) }}" class="block">
                        <x-rental-card :rental="$rental" />
                    </a>
                @endforeach
            </div>
        </div>
    @endif
</x-dashboard-layout>
