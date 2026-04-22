<x-dashboard-layout>
    <x-slot name="title">Buat Pemesanan Rental</x-slot>

    <div class="max-w-3xl mx-auto" x-data="rentalForm()">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
            <h2 class="text-xl font-bold text-secondary mb-6">Form Pemesanan Kendaraan</h2>

            <form method="POST" action="{{ route('customer.rentals.store') }}">
                @csrf

                <!-- Pilih Kendaraan -->
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Pilih Kendaraan <span class="text-red-500">*</span></label>
                    <select name="vehicle_id" x-model="vehicleId" @change="updatePrice()"
                            class="w-full border border-gray-200 rounded-xl px-4 py-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-primary">
                        <option value="">-- Pilih Kendaraan --</option>
                        @foreach($vehicles as $v)
                            <option value="{{ $v->id }}"
                                    data-price="{{ $v->price_per_day }}"
                                    {{ (old('vehicle_id', $vehicle?->id) == $v->id) ? 'selected' : '' }}>
                                {{ $v->name }} ({{ ucfirst($v->type) }}) - Rp {{ number_format($v->price_per_day, 0, ',', '.') }}/hari
                            </option>
                        @endforeach
                    </select>
                    @error('vehicle_id')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                <!-- Tanggal -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Mulai <span class="text-red-500">*</span></label>
                        <input type="date" name="start_date" x-model="startDate" @change="calculateTotal()"
                               min="{{ date('Y-m-d') }}"
                               value="{{ old('start_date') }}"
                               class="w-full border border-gray-200 rounded-xl px-4 py-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-primary">
                        @error('start_date')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Selesai <span class="text-red-500">*</span></label>
                        <input type="date" name="end_date" x-model="endDate" @change="calculateTotal()"
                               min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                               value="{{ old('end_date') }}"
                               class="w-full border border-gray-200 rounded-xl px-4 py-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-primary">
                        @error('end_date')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>

                <!-- Catatan -->
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Catatan (opsional)</label>
                    <textarea name="notes" rows="3" placeholder="Misal: perlu antar ke hotel, dll."
                              class="w-full border border-gray-200 rounded-xl px-4 py-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-primary resize-none">{{ old('notes') }}</textarea>
                </div>

                <!-- Kalkulasi -->
                <div x-show="totalDays > 0" class="bg-blue-50 rounded-2xl p-6 mb-6 space-y-3">
                    <h3 class="font-bold text-secondary mb-3">Ringkasan Pemesanan</h3>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">Durasi</span>
                        <span class="font-semibold text-gray-800"><span x-text="totalDays"></span> hari</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">Harga per hari</span>
                        <span class="font-semibold text-gray-800">Rp <span x-text="formatRp(pricePerDay)"></span></span>
                    </div>
                    <div class="border-t border-blue-200 pt-3 flex justify-between">
                        <span class="font-bold text-gray-800">Total Harga</span>
                        <span class="font-extrabold text-primary text-lg">Rp <span x-text="formatRp(totalPrice)"></span></span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">Deposit (30%)</span>
                        <span class="font-semibold text-orange-600">Rp <span x-text="formatRp(deposit)"></span></span>
                    </div>
                    <p class="text-xs text-gray-500 mt-2">* Deposit dibayar saat pengambilan kendaraan. Pembayaran penuh dilakukan setelah dikonfirmasi staff.</p>
                </div>

                <div class="flex gap-3">
                    <a href="{{ route('customer.dashboard') }}"
                       class="flex-1 text-center border border-gray-200 text-gray-600 font-semibold py-3 rounded-xl hover:bg-gray-50 transition-colors">
                        Batal
                    </a>
                    <button type="submit"
                            class="flex-1 bg-primary text-white font-bold py-3 rounded-xl hover:bg-blue-700 transition-colors">
                        Buat Pemesanan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function rentalForm() {
            return {
                vehicleId: '{{ old('vehicle_id', $vehicle?->id ?? '') }}',
                startDate: '{{ old('start_date') }}',
                endDate: '{{ old('end_date') }}',
                pricePerDay: {{ $vehicle?->price_per_day ?? 0 }},
                totalDays: 0,
                totalPrice: 0,
                deposit: 0,
                updatePrice() {
                    const select = document.querySelector('select[name="vehicle_id"]');
                    const option = select.options[select.selectedIndex];
                    this.pricePerDay = parseInt(option.dataset.price || 0);
                    this.calculateTotal();
                },
                calculateTotal() {
                    if (this.startDate && this.endDate && this.pricePerDay > 0) {
                        const start = new Date(this.startDate);
                        const end = new Date(this.endDate);
                        const diff = Math.ceil((end - start) / (1000 * 60 * 60 * 24));
                        if (diff > 0) {
                            this.totalDays = diff;
                            this.totalPrice = diff * this.pricePerDay;
                            this.deposit = Math.min(this.totalPrice * 0.3, 500000);
                        } else {
                            this.totalDays = 0;
                        }
                    }
                },
                formatRp(val) {
                    return val.toLocaleString('id-ID');
                }
            }
        }
    </script>
</x-dashboard-layout>
