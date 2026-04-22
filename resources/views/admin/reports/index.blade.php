<x-dashboard-layout>
    <x-slot name="title">Laporan</x-slot>

    <!-- Filter -->
    <form method="GET" action="{{ route('admin.reports.index') }}" class="bg-white rounded-2xl border border-gray-100 p-4 mb-6">
        <div class="flex gap-4 items-end">
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1">Tahun</label>
                <select name="year" class="border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary">
                    @for($y = now()->year; $y >= now()->year - 3; $y--)
                        <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>{{ $y }}</option>
                    @endfor
                </select>
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1">Bulan Detail</label>
                <select name="month" class="border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary">
                    @foreach(range(1,12) as $m)
                        <option value="{{ $m }}" {{ $month == $m ? 'selected' : '' }}>{{ \Carbon\Carbon::create()->month($m)->format('F') }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="bg-primary text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-blue-700 transition-colors">Tampilkan</button>
        </div>
    </form>

    <!-- Bulan Terpilih -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
        <div class="bg-white rounded-2xl border border-gray-100 p-6">
            <p class="text-gray-500 text-sm mb-2">Pendapatan {{ \Carbon\Carbon::create()->month($month)->format('F') }} {{ $year }}</p>
            <p class="text-3xl font-extrabold text-primary">Rp {{ number_format($selectedMonthRevenue, 0, ',', '.') }}</p>
        </div>
        <div class="bg-white rounded-2xl border border-gray-100 p-6">
            <p class="text-gray-500 text-sm mb-2">Total Rental {{ \Carbon\Carbon::create()->month($month)->format('F') }} {{ $year }}</p>
            <p class="text-3xl font-extrabold text-secondary">{{ $selectedMonthRentals }}</p>
        </div>
    </div>

    <!-- Pendapatan Per Bulan -->
    <div class="bg-white rounded-2xl border border-gray-100 p-6 mb-6">
        <h3 class="font-bold text-secondary mb-4">Pendapatan Per Bulan {{ $year }}</h3>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="text-left px-4 py-2 font-semibold text-gray-600">Bulan</th>
                        <th class="text-left px-4 py-2 font-semibold text-gray-600">Total Transaksi</th>
                        <th class="text-left px-4 py-2 font-semibold text-gray-600">Pendapatan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach(range(1,12) as $m)
                        @php $data = $monthlyRevenue->get($m); @endphp
                        <tr class="{{ $m == $month ? 'bg-blue-50' : 'hover:bg-gray-50' }}">
                            <td class="px-4 py-3 font-medium text-gray-800">
                                {{ \Carbon\Carbon::create()->month($m)->format('F') }}
                                @if($m == now()->month && $year == now()->year)
                                    <span class="ml-1 px-2 py-0.5 bg-blue-100 text-blue-700 text-xs rounded-full">Ini</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-gray-600">{{ $data?->count ?? 0 }}</td>
                            <td class="px-4 py-3 font-semibold {{ $data?->total > 0 ? 'text-primary' : 'text-gray-400' }}">
                                Rp {{ number_format($data?->total ?? 0, 0, ',', '.') }}
                            </td>
                        </tr>
                    @endforeach
                    <tr class="bg-gray-50 font-bold">
                        <td class="px-4 py-3 text-secondary">TOTAL {{ $year }}</td>
                        <td class="px-4 py-3 text-gray-700">{{ $monthlyRevenue->sum('count') }}</td>
                        <td class="px-4 py-3 text-primary">Rp {{ number_format($monthlyRevenue->sum('total'), 0, ',', '.') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        <!-- Kendaraan Terlaris -->
        <div class="bg-white rounded-2xl border border-gray-100 p-6">
            <h3 class="font-bold text-secondary mb-4">Kendaraan Terlaris {{ $year }}</h3>
            @forelse($popularVehicles as $i => $v)
                <div class="flex items-center gap-3 py-3 border-b border-gray-50 last:border-0">
                    <span class="w-6 h-6 rounded-full bg-primary text-white text-xs font-bold flex items-center justify-center flex-shrink-0">{{ $i+1 }}</span>
                    <div class="w-10 h-10 rounded-lg overflow-hidden bg-gray-100 flex-shrink-0">
                        <img src="{{ $v->image_url ?? '' }}" alt="" class="w-full h-full object-cover">
                    </div>
                    <div class="flex-1">
                        <p class="font-semibold text-gray-800 text-sm">{{ $v->name }}</p>
                        <p class="text-xs text-gray-400 capitalize">{{ $v->type }} &bull; {{ $v->brand }}</p>
                    </div>
                    <span class="font-bold text-primary text-sm">{{ $v->completed_rentals }}x</span>
                </div>
            @empty
                <p class="text-gray-400 text-sm py-4 text-center">Belum ada data</p>
            @endforelse
        </div>

        <!-- Laporan Kerusakan -->
        <div class="bg-white rounded-2xl border border-gray-100 p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="font-bold text-secondary">Kerusakan Terbaru</h3>
                <span class="text-sm text-red-600 font-semibold">Total: Rp {{ number_format($totalDamagesCost, 0, ',', '.') }}</span>
            </div>
            @forelse($recentDamages as $d)
                <div class="py-3 border-b border-gray-50 last:border-0">
                    <div class="flex justify-between items-start">
                        <div class="flex-1 pr-4">
                            <p class="text-sm font-medium text-gray-800">{{ $d->rental->vehicle->name }}</p>
                            <p class="text-xs text-gray-500">{{ $d->description }}</p>
                            <p class="text-xs text-gray-400">{{ $d->rental->user->name }} &bull; {{ $d->created_at->format('d M Y') }}</p>
                        </div>
                        <p class="font-semibold text-red-600 text-sm flex-shrink-0">Rp {{ number_format($d->repair_cost, 0, ',', '.') }}</p>
                    </div>
                </div>
            @empty
                <p class="text-gray-400 text-sm py-4 text-center">Tidak ada kerusakan tercatat</p>
            @endforelse
        </div>
    </div>
</x-dashboard-layout>
