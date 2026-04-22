<x-dashboard-layout>
    <x-slot name="title">Kelola Kendaraan</x-slot>

    <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="text-left px-5 py-3 font-semibold text-gray-600">Kendaraan</th>
                        <th class="text-left px-5 py-3 font-semibold text-gray-600">Plat / Tipe</th>
                        <th class="text-left px-5 py-3 font-semibold text-gray-600">Harga/Hari</th>
                        <th class="text-left px-5 py-3 font-semibold text-gray-600">Status</th>
                        <th class="text-left px-5 py-3 font-semibold text-gray-600">Aktif Rental</th>
                        <th class="text-left px-5 py-3 font-semibold text-gray-600">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($vehicles as $vehicle)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-5 py-3">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-lg overflow-hidden bg-gray-100 flex-shrink-0">
                                        <img src="{{ $vehicle->image_url ?? '' }}" alt="" class="w-full h-full object-cover">
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-800">{{ $vehicle->name }}</p>
                                        <p class="text-xs text-gray-400">{{ $vehicle->brand }} {{ $vehicle->year }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-5 py-3">
                                <p class="text-gray-800">{{ $vehicle->plate_number }}</p>
                                <p class="text-xs text-gray-400 capitalize">{{ $vehicle->type }} &bull; {{ $vehicle->transmission }}</p>
                            </td>
                            <td class="px-5 py-3 font-semibold text-gray-800">
                                Rp {{ number_format($vehicle->price_per_day, 0, ',', '.') }}
                            </td>
                            <td class="px-5 py-3">
                                <span class="px-2 py-1 rounded-full text-xs font-semibold
                                    {{ match($vehicle->status) {
                                        'available' => 'bg-green-100 text-green-700',
                                        'rented' => 'bg-blue-100 text-blue-700',
                                        'maintenance' => 'bg-orange-100 text-orange-700',
                                        default => 'bg-gray-100',
                                    } }}">
                                    {{ match($vehicle->status) { 'available' => 'Tersedia', 'rented' => 'Disewa', 'maintenance' => 'Perawatan', default => ucfirst($vehicle->status) } }}
                                </span>
                            </td>
                            <td class="px-5 py-3">
                                @if($vehicle->active_rentals_count > 0)
                                    <span class="text-primary font-semibold">{{ $vehicle->active_rentals_count }} rental</span>
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>
                            <td class="px-5 py-3" x-data="{ open: false }">
                                <button @click="open = !open" class="text-primary text-sm font-medium hover:underline">Ubah Status</button>

                                <div x-show="open" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4" @click.self="open = false">
                                    <div class="bg-white rounded-2xl p-6 max-w-xs w-full">
                                        <h4 class="font-bold text-secondary mb-4">Ubah Status: {{ $vehicle->name }}</h4>
                                        <form method="POST" action="{{ route('staff.vehicles.status', $vehicle) }}">
                                            @csrf
                                            <select name="status" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 mb-4 focus:outline-none focus:ring-2 focus:ring-primary">
                                                <option value="available" {{ $vehicle->status === 'available' ? 'selected' : '' }}>Tersedia</option>
                                                <option value="rented" {{ $vehicle->status === 'rented' ? 'selected' : '' }}>Disewa</option>
                                                <option value="maintenance" {{ $vehicle->status === 'maintenance' ? 'selected' : '' }}>Perawatan</option>
                                            </select>
                                            <div class="flex gap-2">
                                                <button type="button" @click="open = false" class="flex-1 border border-gray-200 py-2 rounded-xl text-sm font-semibold text-gray-600">Batal</button>
                                                <button type="submit" class="flex-1 bg-primary text-white py-2 rounded-xl text-sm font-semibold hover:bg-blue-700">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center py-10 text-gray-400">Tidak ada kendaraan</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($vehicles->hasPages())
            <div class="px-5 py-4 border-t border-gray-100">{{ $vehicles->links() }}</div>
        @endif
    </div>
</x-dashboard-layout>
