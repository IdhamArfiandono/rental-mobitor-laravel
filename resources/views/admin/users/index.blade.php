<x-dashboard-layout>
    <x-slot name="title">Kelola Pengguna</x-slot>

    <div class="flex items-center justify-between mb-6">
        <h2 class="text-xl font-bold text-secondary">Pengguna</h2>
        <a href="{{ route('admin.users.create') }}"
           class="inline-flex items-center gap-2 bg-primary text-white font-semibold px-4 py-2 rounded-lg text-sm hover:bg-blue-700 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
            Tambah Pengguna
        </a>
    </div>

    <!-- Staff -->
    <div class="mb-8">
        <h3 class="text-lg font-bold text-secondary mb-3">Staff ({{ $staff->count() }})</h3>
        <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="text-left px-5 py-3 font-semibold text-gray-600">Nama</th>
                        <th class="text-left px-5 py-3 font-semibold text-gray-600">Email</th>
                        <th class="text-left px-5 py-3 font-semibold text-gray-600">Telepon</th>
                        <th class="text-left px-5 py-3 font-semibold text-gray-600">Total Proses</th>
                        <th class="text-left px-5 py-3 font-semibold text-gray-600">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($staff as $s)
                        <tr class="hover:bg-gray-50">
                            <td class="px-5 py-3">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center text-primary font-bold text-sm">
                                        {{ strtoupper(substr($s->name, 0, 1)) }}
                                    </div>
                                    <span class="font-semibold text-gray-800">{{ $s->name }}</span>
                                </div>
                            </td>
                            <td class="px-5 py-3 text-gray-600">{{ $s->email }}</td>
                            <td class="px-5 py-3 text-gray-600">{{ $s->phone }}</td>
                            <td class="px-5 py-3 text-gray-600">{{ $s->staff_rentals_count }} rental</td>
                            <td class="px-5 py-3">
                                <div class="flex gap-3">
                                    <a href="{{ route('admin.users.edit', $s) }}" class="text-primary hover:underline text-sm font-medium">Edit</a>
                                    @if($s->id !== auth()->id())
                                        <form method="POST" action="{{ route('admin.users.destroy', $s) }}" onsubmit="return confirm('Nonaktifkan pengguna ini?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:underline text-sm font-medium">Nonaktifkan</button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center py-8 text-gray-400">Belum ada staff</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pelanggan -->
    <div>
        <h3 class="text-lg font-bold text-secondary mb-3">Pelanggan ({{ $customers->total() }})</h3>
        <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="text-left px-5 py-3 font-semibold text-gray-600">Nama</th>
                        <th class="text-left px-5 py-3 font-semibold text-gray-600">Email</th>
                        <th class="text-left px-5 py-3 font-semibold text-gray-600">Telepon</th>
                        <th class="text-left px-5 py-3 font-semibold text-gray-600">Total Rental</th>
                        <th class="text-left px-5 py-3 font-semibold text-gray-600">Bergabung</th>
                        <th class="text-left px-5 py-3 font-semibold text-gray-600">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($customers as $c)
                        <tr class="hover:bg-gray-50">
                            <td class="px-5 py-3">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center text-green-700 font-bold text-sm">
                                        {{ strtoupper(substr($c->name, 0, 1)) }}
                                    </div>
                                    <span class="font-semibold text-gray-800">{{ $c->name }}</span>
                                </div>
                            </td>
                            <td class="px-5 py-3 text-gray-600">{{ $c->email }}</td>
                            <td class="px-5 py-3 text-gray-600">{{ $c->phone }}</td>
                            <td class="px-5 py-3 text-gray-600">{{ $c->rentals_count }}</td>
                            <td class="px-5 py-3 text-gray-500">{{ $c->created_at->format('d M Y') }}</td>
                            <td class="px-5 py-3">
                                <div class="flex gap-3">
                                    <a href="{{ route('admin.users.edit', $c) }}" class="text-primary hover:underline text-sm font-medium">Edit</a>
                                    <form method="POST" action="{{ route('admin.users.destroy', $c) }}" onsubmit="return confirm('Nonaktifkan pelanggan ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:underline text-sm font-medium">Nonaktifkan</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center py-8 text-gray-400">Belum ada pelanggan</td></tr>
                    @endforelse
                </tbody>
            </table>
            @if($customers->hasPages())
                <div class="px-5 py-4 border-t border-gray-100">{{ $customers->links() }}</div>
            @endif
        </div>
    </div>
</x-dashboard-layout>
