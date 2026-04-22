<x-dashboard-layout>
    <x-slot name="title">Dashboard Admin</x-slot>

    <!-- Stats -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div class="bg-white rounded-2xl border border-gray-100 p-5">
            <div class="flex items-center justify-between mb-3">
                <p class="text-gray-500 text-sm">Pendapatan Bulan Ini</p>
                <div class="w-9 h-9 bg-green-100 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
            </div>
            <p class="text-2xl font-extrabold text-gray-800">Rp {{ number_format($monthlyRevenue, 0, ',', '.') }}</p>
            <p class="text-xs text-gray-400 mt-1">{{ now()->format('F Y') }}</p>
        </div>
        <div class="bg-white rounded-2xl border border-gray-100 p-5">
            <div class="flex items-center justify-between mb-3">
                <p class="text-gray-500 text-sm">Rental Aktif</p>
                <div class="w-9 h-9 bg-blue-100 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                </div>
            </div>
            <p class="text-2xl font-extrabold text-gray-800">{{ $activeRentals }}</p>
            <p class="text-xs text-gray-400 mt-1">Konfirmasi + Berlangsung</p>
        </div>
        <div class="bg-white rounded-2xl border border-gray-100 p-5">
            <div class="flex items-center justify-between mb-3">
                <p class="text-gray-500 text-sm">Total Pelanggan</p>
                <div class="w-9 h-9 bg-purple-100 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                </div>
            </div>
            <p class="text-2xl font-extrabold text-gray-800">{{ $totalCustomers }}</p>
            <p class="text-xs text-gray-400 mt-1">Pelanggan terdaftar</p>
        </div>
        <div class="bg-white rounded-2xl border border-gray-100 p-5">
            <div class="flex items-center justify-between mb-3">
                <p class="text-gray-500 text-sm">Armada Kendaraan</p>
                <div class="w-9 h-9 bg-yellow-100 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/></svg>
                </div>
            </div>
            <p class="text-2xl font-extrabold text-gray-800">{{ $vehicleStats->sum() }}</p>
            <p class="text-xs text-gray-400 mt-1">Total kendaraan</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Grafik Pendapatan 7 Hari -->
        <div class="lg:col-span-2 bg-white rounded-2xl border border-gray-100 p-6">
            <h3 class="font-bold text-secondary mb-4">Pendapatan 7 Hari Terakhir</h3>
            @php
                $maxRevenue = max(array_values($last7Days->toArray())) ?: 1;
            @endphp
            <div class="flex items-end gap-3 h-32">
                @foreach($last7Days as $date => $amount)
                    @php
                        $height = $maxRevenue > 0 ? round(($amount / $maxRevenue) * 100) : 0;
                    @endphp
                    <div class="flex-1 flex flex-col items-center gap-1">
                        <p class="text-xs text-gray-500 font-medium">{{ number_format($amount/1000, 0) }}k</p>
                        <div class="w-full bg-blue-100 rounded-t-lg relative" style="height: {{ max($height, 4) }}%">
                            <div class="absolute inset-0 bg-primary rounded-t-lg opacity-80"></div>
                        </div>
                        <p class="text-xs text-gray-400">{{ \Carbon\Carbon::parse($date)->format('d/m') }}</p>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Status Kendaraan -->
        <div class="bg-white rounded-2xl border border-gray-100 p-6">
            <h3 class="font-bold text-secondary mb-4">Status Armada</h3>
            <div class="space-y-4">
                @php
                    $statuses = [
                        'available' => ['label' => 'Tersedia', 'color' => 'bg-green-500', 'text' => 'text-green-700', 'bg' => 'bg-green-100'],
                        'rented' => ['label' => 'Disewa', 'color' => 'bg-blue-500', 'text' => 'text-blue-700', 'bg' => 'bg-blue-100'],
                        'maintenance' => ['label' => 'Perawatan', 'color' => 'bg-orange-500', 'text' => 'text-orange-700', 'bg' => 'bg-orange-100'],
                    ];
                    $totalVehicles = $vehicleStats->sum() ?: 1;
                @endphp
                @foreach($statuses as $key => $s)
                    @php $count = $vehicleStats->get($key, 0); @endphp
                    <div>
                        <div class="flex justify-between items-center mb-1">
                            <span class="text-sm font-medium text-gray-700">{{ $s['label'] }}</span>
                            <span class="text-sm font-bold {{ $s['text'] }}">{{ $count }}</span>
                        </div>
                        <div class="w-full h-2 bg-gray-100 rounded-full overflow-hidden">
                            <div class="{{ $s['color'] }} h-2 rounded-full"
                                 style="width: {{ round(($count / $totalVehicles) * 100) }}%"></div>
                        </div>
                    </div>
                @endforeach
                <div class="pt-2 border-t border-gray-100">
                    <a href="{{ route('admin.vehicles.index') }}" class="text-primary text-sm font-semibold hover:underline">Kelola Kendaraan</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="mt-6 grid grid-cols-2 md:grid-cols-4 gap-4">
        <a href="{{ route('admin.vehicles.create') }}" class="bg-white rounded-2xl border border-gray-100 p-5 hover:shadow-sm transition-shadow flex items-center gap-3">
            <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center">
                <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            </div>
            <span class="font-semibold text-gray-800 text-sm">Tambah Kendaraan</span>
        </a>
        <a href="{{ route('admin.users.create') }}" class="bg-white rounded-2xl border border-gray-100 p-5 hover:shadow-sm transition-shadow flex items-center gap-3">
            <div class="w-10 h-10 bg-green-100 rounded-xl flex items-center justify-center">
                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
            </div>
            <span class="font-semibold text-gray-800 text-sm">Tambah Staff</span>
        </a>
        <a href="{{ route('admin.reports.index') }}" class="bg-white rounded-2xl border border-gray-100 p-5 hover:shadow-sm transition-shadow flex items-center gap-3">
            <div class="w-10 h-10 bg-purple-100 rounded-xl flex items-center justify-center">
                <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            </div>
            <span class="font-semibold text-gray-800 text-sm">Lihat Laporan</span>
        </a>
        <a href="{{ route('staff.rentals.index', ['status' => 'pending']) }}" class="bg-white rounded-2xl border border-gray-100 p-5 hover:shadow-sm transition-shadow flex items-center gap-3">
            <div class="w-10 h-10 bg-yellow-100 rounded-xl flex items-center justify-center">
                <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <span class="font-semibold text-gray-800 text-sm">Rental Pending</span>
        </a>
    </div>
</x-dashboard-layout>
