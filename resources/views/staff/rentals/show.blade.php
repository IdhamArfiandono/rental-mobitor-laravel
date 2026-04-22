<x-dashboard-layout>
    <x-slot name="title">Detail Rental #{{ $rental->id }}</x-slot>

    <div class="mb-4">
        <a href="{{ route('staff.rentals.index') }}" class="inline-flex items-center gap-2 text-gray-500 hover:text-primary text-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Kembali ke Daftar
        </a>
    </div>

    @php
        $statusLabel = match($rental->status) {
            'pending' => 'Menunggu', 'confirmed' => 'Dikonfirmasi',
            'ongoing' => 'Berlangsung', 'completed' => 'Selesai', 'cancelled' => 'Dibatalkan',
            default => ucfirst($rental->status),
        };
    @endphp

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 space-y-6">
            <!-- Info Rental -->
            <div class="bg-white rounded-2xl border border-gray-100 p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-bold text-secondary">Informasi Rental</h3>
                    <span class="text-sm text-gray-400">#{{ $rental->id }}</span>
                </div>
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div><p class="text-gray-500">Pelanggan</p><p class="font-semibold text-gray-800">{{ $rental->user->name }}</p><p class="text-gray-400">{{ $rental->user->phone }}</p></div>
                    <div><p class="text-gray-500">Kendaraan</p><p class="font-semibold text-gray-800">{{ $rental->vehicle->name }}</p><p class="text-gray-400">{{ $rental->vehicle->plate_number }}</p></div>
                    <div><p class="text-gray-500">Mulai</p><p class="font-semibold text-gray-800">{{ $rental->start_date->format('d M Y') }}</p></div>
                    <div><p class="text-gray-500">Selesai</p><p class="font-semibold text-gray-800">{{ $rental->end_date->format('d M Y') }}</p></div>
                    <div><p class="text-gray-500">Total Hari</p><p class="font-semibold text-gray-800">{{ $rental->total_days }} hari</p></div>
                    <div><p class="text-gray-500">Total Harga</p><p class="font-semibold text-primary">Rp {{ number_format($rental->total_price, 0, ',', '.') }}</p></div>
                </div>
                @if($rental->notes)
                    <div class="mt-4 pt-4 border-t border-gray-100">
                        <p class="text-gray-500 text-sm">Catatan</p>
                        <p class="text-gray-800">{{ $rental->notes }}</p>
                    </div>
                @endif
            </div>

            <!-- Update Status -->
            @if(!in_array($rental->status, ['completed', 'cancelled']))
                <div class="bg-white rounded-2xl border border-gray-100 p-6">
                    <h3 class="font-bold text-secondary mb-4">Update Status</h3>
                    <form method="POST" action="{{ route('staff.rentals.update', $rental) }}">
                        @csrf @method('PUT')
                        <div class="flex gap-3">
                            <select name="status" class="flex-1 border border-gray-200 rounded-xl px-4 py-2.5 text-gray-700 focus:outline-none focus:ring-2 focus:ring-primary">
                                @if($rental->status === 'pending')
                                    <option value="confirmed">Konfirmasi</option>
                                    <option value="cancelled">Batalkan</option>
                                @elseif($rental->status === 'confirmed')
                                    <option value="ongoing">Mulai (Ambil Kendaraan)</option>
                                    <option value="cancelled">Batalkan</option>
                                @elseif($rental->status === 'ongoing')
                                    <option value="completed">Selesai (Kendaraan Kembali)</option>
                                @endif
                            </select>
                            <button type="submit" class="bg-primary text-white px-6 py-2.5 rounded-xl font-semibold hover:bg-blue-700 transition-colors">
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            @endif

            <!-- Perpanjangan -->
            @if($rental->status === 'ongoing')
                <div class="bg-white rounded-2xl border border-gray-100 p-6">
                    <h3 class="font-bold text-secondary mb-4">Perpanjangan Rental</h3>
                    <form method="POST" action="{{ route('staff.rentals.extend', $rental) }}">
                        @csrf
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Tambah Hari</label>
                                <input type="number" name="extended_days" min="1" max="30"
                                       class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-primary"
                                       placeholder="Jumlah hari">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Harga/hari</label>
                                <input type="text" value="Rp {{ number_format($rental->vehicle->price_per_day, 0, ',', '.') }}" readonly
                                       class="w-full border border-gray-100 bg-gray-50 rounded-xl px-4 py-2.5 text-gray-500">
                            </div>
                        </div>
                        <div class="mt-4">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Alasan Perpanjangan</label>
                            <input type="text" name="reason" placeholder="Opsional"
                                   class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-primary">
                        </div>
                        <button type="submit" class="mt-4 bg-green-600 text-white px-6 py-2.5 rounded-xl font-semibold hover:bg-green-700 transition-colors">
                            Perpanjang Rental
                        </button>
                    </form>
                </div>
            @endif

            <!-- Catat Kerusakan -->
            @if(in_array($rental->status, ['ongoing', 'completed']))
                <div class="bg-white rounded-2xl border border-gray-100 p-6">
                    <h3 class="font-bold text-secondary mb-4">Catat Kerusakan</h3>
                    <form method="POST" action="{{ route('staff.rentals.damage', $rental) }}">
                        @csrf
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi Kerusakan</label>
                                <textarea name="description" rows="2" required
                                          class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-primary resize-none"
                                          placeholder="Jelaskan kerusakan yang ditemukan..."></textarea>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Biaya Perbaikan (Rp)</label>
                                <input type="number" name="repair_cost" min="0" required
                                       class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-primary"
                                       placeholder="0">
                            </div>
                        </div>
                        <button type="submit" class="mt-4 bg-red-600 text-white px-6 py-2.5 rounded-xl font-semibold hover:bg-red-700 transition-colors">
                            Simpan Catatan
                        </button>
                    </form>
                </div>
            @endif

            <!-- Riwayat Kerusakan -->
            @if($rental->damages->count() > 0)
                <div class="bg-white rounded-2xl border border-red-100 p-6">
                    <h3 class="font-bold text-red-700 mb-4">Kerusakan Tercatat</h3>
                    @foreach($rental->damages as $d)
                        <div class="flex justify-between items-start py-2 border-b border-red-50 last:border-0">
                            <p class="text-gray-800 text-sm flex-1 pr-4">{{ $d->description }}</p>
                            <p class="font-semibold text-red-600 text-sm flex-shrink-0">Rp {{ number_format($d->repair_cost, 0, ',', '.') }}</p>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <div class="bg-white rounded-2xl border border-gray-100 p-6">
                <h3 class="font-bold text-secondary mb-4">Status & Pembayaran</h3>
                <div class="space-y-3 text-sm">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-500">Status Rental</span>
                        <span class="px-3 py-1 rounded-full text-xs font-semibold
                            {{ match($rental->status) {
                                'pending' => 'bg-yellow-100 text-yellow-700',
                                'confirmed' => 'bg-blue-100 text-blue-700',
                                'ongoing' => 'bg-green-100 text-green-700',
                                'completed' => 'bg-gray-100 text-gray-600',
                                'cancelled' => 'bg-red-100 text-red-700',
                                default => 'bg-gray-100',
                            } }}">
                            {{ $statusLabel }}
                        </span>
                    </div>
                    @if($rental->payment)
                        <div class="flex justify-between items-center">
                            <span class="text-gray-500">Pembayaran</span>
                            <span class="px-3 py-1 rounded-full text-xs font-semibold
                                {{ $rental->payment->status === 'paid' ? 'bg-green-100 text-green-700' : 'bg-orange-100 text-orange-700' }}">
                                {{ $rental->payment->status === 'paid' ? 'Lunas' : 'Belum Bayar' }}
                            </span>
                        </div>
                    @endif
                    <div class="border-t border-gray-100 pt-3">
                        <div class="flex justify-between"><span class="text-gray-500">Total</span><span class="font-bold text-primary">Rp {{ number_format($rental->total_price, 0, ',', '.') }}</span></div>
                        <div class="flex justify-between mt-1"><span class="text-gray-500">Deposit</span><span class="font-semibold text-orange-600">Rp {{ number_format($rental->deposit, 0, ',', '.') }}</span></div>
                    </div>
                </div>
                @if($rental->payment && $rental->payment->status === 'pending')
                    <a href="{{ route('staff.payments.index') }}" class="block mt-4 text-center bg-green-600 text-white font-semibold py-2.5 rounded-xl hover:bg-green-700 transition-colors text-sm">
                        Konfirmasi Pembayaran
                    </a>
                @endif
            </div>

            @if($rental->extensions->count() > 0)
                <div class="bg-white rounded-2xl border border-gray-100 p-6">
                    <h3 class="font-bold text-secondary mb-3">Perpanjangan</h3>
                    @foreach($rental->extensions as $ext)
                        <div class="flex justify-between text-sm py-2 border-b border-gray-50 last:border-0">
                            <span class="text-gray-600">+{{ $ext->extended_days }} hari</span>
                            <span class="font-semibold text-primary">+Rp {{ number_format($ext->additional_cost, 0, ',', '.') }}</span>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-dashboard-layout>
