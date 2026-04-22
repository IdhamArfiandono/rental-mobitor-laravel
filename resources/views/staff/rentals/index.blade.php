<x-dashboard-layout>
    <x-slot name="title">Kelola Rental</x-slot>

    <!-- Filter -->
    <form method="GET" action="{{ route('staff.rentals.index') }}" class="bg-white rounded-2xl border border-gray-100 p-4 mb-6">
        <div class="flex flex-wrap gap-3 items-end">
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1">Status</label>
                <select name="status" class="border border-gray-200 rounded-lg px-3 py-2 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-primary">
                    <option value="">Semua Status</option>
                    @foreach(['pending' => 'Menunggu', 'confirmed' => 'Dikonfirmasi', 'ongoing' => 'Berlangsung', 'completed' => 'Selesai', 'cancelled' => 'Dibatalkan'] as $val => $label)
                        <option value="{{ $val }}" {{ request('status') === $val ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1">Tanggal Mulai</label>
                <input type="date" name="date" value="{{ request('date') }}"
                       class="border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary">
            </div>
            <button type="submit" class="bg-primary text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-blue-700 transition-colors">Filter</button>
            <a href="{{ route('staff.rentals.index') }}" class="px-4 py-2 border border-gray-200 rounded-lg text-sm text-gray-600 hover:bg-gray-50">Reset</a>
        </div>
    </form>

    <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="text-left px-5 py-3 font-semibold text-gray-600">#</th>
                        <th class="text-left px-5 py-3 font-semibold text-gray-600">Pelanggan</th>
                        <th class="text-left px-5 py-3 font-semibold text-gray-600">Kendaraan</th>
                        <th class="text-left px-5 py-3 font-semibold text-gray-600">Tanggal</th>
                        <th class="text-left px-5 py-3 font-semibold text-gray-600">Total</th>
                        <th class="text-left px-5 py-3 font-semibold text-gray-600">Status</th>
                        <th class="text-left px-5 py-3 font-semibold text-gray-600">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($rentals as $rental)
                        @php
                            $statusColor = match($rental->status) {
                                'pending' => 'bg-yellow-100 text-yellow-700',
                                'confirmed' => 'bg-blue-100 text-blue-700',
                                'ongoing' => 'bg-green-100 text-green-700',
                                'completed' => 'bg-gray-100 text-gray-600',
                                'cancelled' => 'bg-red-100 text-red-700',
                                default => 'bg-gray-100',
                            };
                            $statusLabel = match($rental->status) {
                                'pending' => 'Menunggu', 'confirmed' => 'Konfirmasi',
                                'ongoing' => 'Berlangsung', 'completed' => 'Selesai', 'cancelled' => 'Batal',
                                default => ucfirst($rental->status),
                            };
                        @endphp
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-5 py-3 text-gray-400">{{ $rental->id }}</td>
                            <td class="px-5 py-3">
                                <p class="font-medium text-gray-800">{{ $rental->user->name }}</p>
                                <p class="text-xs text-gray-400">{{ $rental->user->phone }}</p>
                            </td>
                            <td class="px-5 py-3">
                                <p class="font-medium text-gray-800">{{ $rental->vehicle->name }}</p>
                                <p class="text-xs text-gray-400">{{ $rental->vehicle->plate_number }}</p>
                            </td>
                            <td class="px-5 py-3 text-gray-600">
                                {{ $rental->start_date->format('d M') }} - {{ $rental->end_date->format('d M Y') }}
                                <p class="text-xs text-gray-400">{{ $rental->total_days }} hari</p>
                            </td>
                            <td class="px-5 py-3 font-semibold text-gray-800">
                                Rp {{ number_format($rental->total_price, 0, ',', '.') }}
                            </td>
                            <td class="px-5 py-3">
                                <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $statusColor }}">{{ $statusLabel }}</span>
                            </td>
                            <td class="px-5 py-3">
                                <a href="{{ route('staff.rentals.show', $rental) }}"
                                   class="text-primary hover:underline text-sm font-medium">Detail</a>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="text-center py-10 text-gray-400">Tidak ada data rental</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($rentals->hasPages())
            <div class="px-5 py-4 border-t border-gray-100">
                {{ $rentals->links() }}
            </div>
        @endif
    </div>
</x-dashboard-layout>
