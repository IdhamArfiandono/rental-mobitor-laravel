<x-dashboard-layout>
    <x-slot name="title">Kelola Kendaraan</x-slot>

    <div class="flex items-center justify-between mb-6">
        <h2 class="text-xl font-bold text-secondary">Daftar Kendaraan</h2>
        <a href="{{ route('admin.vehicles.create') }}"
           class="inline-flex items-center gap-2 bg-primary text-white font-semibold px-4 py-2 rounded-lg text-sm hover:bg-blue-700 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Tambah Kendaraan
        </a>
    </div>

    <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="text-left px-5 py-3 font-semibold text-gray-600">Kendaraan</th>
                        <th class="text-left px-5 py-3 font-semibold text-gray-600">Tipe & Transmisi</th>
                        <th class="text-left px-5 py-3 font-semibold text-gray-600">Harga/Hari</th>
                        <th class="text-left px-5 py-3 font-semibold text-gray-600">Status</th>
                        <th class="text-left px-5 py-3 font-semibold text-gray-600">Total Rental</th>
                        <th class="text-left px-5 py-3 font-semibold text-gray-600">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($vehicles as $vehicle)
                        <tr class="hover:bg-gray-50 transition-colors {{ $vehicle->trashed() ? 'opacity-50' : '' }}">
                            <td class="px-5 py-3">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-lg overflow-hidden bg-gray-100 flex-shrink-0">
                                        <img src="{{ $vehicle->image_url ?? '' }}" alt="" class="w-full h-full object-cover">
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-800">{{ $vehicle->name }}</p>
                                        <p class="text-xs text-gray-400">{{ $vehicle->brand }} &bull; {{ $vehicle->year }} &bull; {{ $vehicle->plate_number }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-5 py-3">
                                <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $vehicle->type === 'motor' ? 'bg-green-100 text-green-700' : 'bg-blue-100 text-blue-700' }}">
                                    {{ ucfirst($vehicle->type) }}
                                </span>
                                <p class="text-xs text-gray-400 mt-1 capitalize">{{ $vehicle->transmission }}</p>
                            </td>
                            <td class="px-5 py-3 font-semibold text-gray-800">
                                Rp {{ number_format($vehicle->price_per_day, 0, ',', '.') }}
                            </td>
                            <td class="px-5 py-3">
                                @if($vehicle->trashed())
                                    <span class="px-2 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-500">Dihapus</span>
                                @else
                                    <span class="px-2 py-1 rounded-full text-xs font-semibold
                                        {{ match($vehicle->status) { 'available' => 'bg-green-100 text-green-700', 'rented' => 'bg-blue-100 text-blue-700', 'maintenance' => 'bg-orange-100 text-orange-700', default => 'bg-gray-100' } }}">
                                        {{ match($vehicle->status) { 'available' => 'Tersedia', 'rented' => 'Disewa', 'maintenance' => 'Perawatan', default => ucfirst($vehicle->status) } }}
                                    </span>
                                @endif
                            </td>
                            <td class="px-5 py-3 text-gray-600">{{ $vehicle->rentals_count }}</td>
                            <td class="px-5 py-3">
                                @if(!$vehicle->trashed())
                                    <div class="flex items-center gap-3">
                                        <a href="{{ route('admin.vehicles.edit', $vehicle) }}" class="text-primary hover:underline text-sm font-medium">Edit</a>
                                        <form method="POST" action="{{ route('admin.vehicles.destroy', $vehicle) }}"
                                              onsubmit="return confirm('Hapus kendaraan ini?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:underline text-sm font-medium">Hapus</button>
                                        </form>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center py-10 text-gray-400">Belum ada kendaraan</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($vehicles->hasPages())
            <div class="px-5 py-4 border-t border-gray-100">{{ $vehicles->links() }}</div>
        @endif
    </div>
</x-dashboard-layout>
