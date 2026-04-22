<x-dashboard-layout>
    <x-slot name="title">Dashboard Staff</x-slot>

    <!-- Stats -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div class="bg-white rounded-2xl border border-gray-100 p-5">
            <p class="text-gray-500 text-sm mb-1">Mulai Hari Ini</p>
            <p class="text-3xl font-extrabold text-primary">{{ $startingToday->count() }}</p>
        </div>
        <div class="bg-white rounded-2xl border border-gray-100 p-5">
            <p class="text-gray-500 text-sm mb-1">Kembali Hari Ini</p>
            <p class="text-3xl font-extrabold text-green-600">{{ $returningToday->count() }}</p>
        </div>
        <div class="bg-white rounded-2xl border border-gray-100 p-5">
            <p class="text-gray-500 text-sm mb-1">Dalam Perawatan</p>
            <p class="text-3xl font-extrabold text-orange-500">{{ $maintenance->count() }}</p>
        </div>
        <div class="bg-white rounded-2xl border border-gray-100 p-5">
            <p class="text-gray-500 text-sm mb-1">Menunggu Konfirmasi</p>
            <p class="text-3xl font-extrabold text-yellow-500">{{ $pendingRentals->count() }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Rental Mulai Hari Ini -->
        <div class="bg-white rounded-2xl border border-gray-100 p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="font-bold text-secondary">Rental Mulai Hari Ini</h3>
                <a href="{{ route('staff.rentals.index', ['date' => now()->toDateString()]) }}" class="text-primary text-sm hover:underline">Lihat Semua</a>
            </div>
            @forelse($startingToday as $rental)
                <a href="{{ route('staff.rentals.show', $rental) }}" class="flex items-center gap-3 py-3 border-b border-gray-50 last:border-0 hover:bg-gray-50 rounded-lg px-2 transition-colors">
                    <div class="w-10 h-10 rounded-lg overflow-hidden bg-gray-100 flex-shrink-0">
                        <img src="{{ $rental->vehicle->image_url ?? '' }}" class="w-full h-full object-cover">
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="font-semibold text-gray-800 text-sm truncate">{{ $rental->vehicle->name }}</p>
                        <p class="text-xs text-gray-500">{{ $rental->user->name }}</p>
                    </div>
                    <span class="px-2 py-1 rounded-full text-xs font-semibold
                        {{ $rental->status === 'confirmed' ? 'bg-blue-100 text-blue-700' : 'bg-green-100 text-green-700' }}">
                        {{ $rental->status === 'confirmed' ? 'Konfirmasi' : 'Berlangsung' }}
                    </span>
                </a>
            @empty
                <p class="text-gray-400 text-sm py-4 text-center">Tidak ada rental yang mulai hari ini</p>
            @endforelse
        </div>

        <!-- Kembali Hari Ini -->
        <div class="bg-white rounded-2xl border border-gray-100 p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="font-bold text-secondary">Harus Kembali Hari Ini</h3>
            </div>
            @forelse($returningToday as $rental)
                <a href="{{ route('staff.rentals.show', $rental) }}" class="flex items-center gap-3 py-3 border-b border-gray-50 last:border-0 hover:bg-gray-50 rounded-lg px-2 transition-colors">
                    <div class="w-10 h-10 rounded-lg overflow-hidden bg-gray-100 flex-shrink-0">
                        <img src="{{ $rental->vehicle->image_url ?? '' }}" class="w-full h-full object-cover">
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="font-semibold text-gray-800 text-sm truncate">{{ $rental->vehicle->name }}</p>
                        <p class="text-xs text-gray-500">{{ $rental->user->name }}</p>
                    </div>
                    <span class="px-2 py-1 rounded-full text-xs font-semibold bg-orange-100 text-orange-700">
                        Kembalikan
                    </span>
                </a>
            @empty
                <p class="text-gray-400 text-sm py-4 text-center">Tidak ada kendaraan yang harus kembali hari ini</p>
            @endforelse
        </div>

        <!-- Pending Rentals -->
        <div class="bg-white rounded-2xl border border-gray-100 p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="font-bold text-secondary">Menunggu Konfirmasi</h3>
                <a href="{{ route('staff.rentals.index', ['status' => 'pending']) }}" class="text-primary text-sm hover:underline">Lihat Semua</a>
            </div>
            @forelse($pendingRentals as $rental)
                <a href="{{ route('staff.rentals.show', $rental) }}" class="flex items-center gap-3 py-3 border-b border-gray-50 last:border-0 hover:bg-gray-50 rounded-lg px-2 transition-colors">
                    <div class="w-10 h-10 rounded-lg overflow-hidden bg-gray-100 flex-shrink-0">
                        <img src="{{ $rental->vehicle->image_url ?? '' }}" class="w-full h-full object-cover">
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="font-semibold text-gray-800 text-sm truncate">{{ $rental->vehicle->name }}</p>
                        <p class="text-xs text-gray-500">{{ $rental->user->name }} &bull; {{ $rental->start_date->format('d M') }}</p>
                    </div>
                    <span class="px-2 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-700">Pending</span>
                </a>
            @empty
                <p class="text-gray-400 text-sm py-4 text-center">Tidak ada rental yang menunggu</p>
            @endforelse
        </div>

        <!-- Dalam Perawatan -->
        <div class="bg-white rounded-2xl border border-gray-100 p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="font-bold text-secondary">Kendaraan Dalam Perawatan</h3>
                <a href="{{ route('staff.vehicles.index') }}" class="text-primary text-sm hover:underline">Kelola</a>
            </div>
            @forelse($maintenance as $vehicle)
                <div class="flex items-center gap-3 py-3 border-b border-gray-50 last:border-0">
                    <div class="w-10 h-10 rounded-lg overflow-hidden bg-gray-100 flex-shrink-0">
                        <img src="{{ $vehicle->image_url ?? '' }}" class="w-full h-full object-cover">
                    </div>
                    <div class="flex-1">
                        <p class="font-semibold text-gray-800 text-sm">{{ $vehicle->name }}</p>
                        <p class="text-xs text-gray-500">{{ $vehicle->plate_number }}</p>
                    </div>
                    <span class="px-2 py-1 rounded-full text-xs font-semibold bg-orange-100 text-orange-700">Perawatan</span>
                </div>
            @empty
                <p class="text-gray-400 text-sm py-4 text-center">Tidak ada kendaraan dalam perawatan</p>
            @endforelse
        </div>
    </div>
</x-dashboard-layout>
