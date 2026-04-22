<x-dashboard-layout>
    <x-slot name="title">Kwitansi Pembayaran</x-slot>

    <div class="max-w-lg mx-auto">
        <div class="flex justify-end mb-4">
            <button onclick="window.print()" class="bg-primary text-white px-5 py-2 rounded-lg text-sm font-semibold hover:bg-blue-700 transition-colors">
                Cetak Kwitansi
            </button>
        </div>

        <div class="bg-white rounded-2xl border border-gray-200 p-8 print:shadow-none">
            <div class="text-center border-b border-gray-200 pb-6 mb-6">
                <h1 class="text-2xl font-extrabold text-secondary">Rental Mobitor</h1>
                <p class="text-gray-500 text-sm">Jl. Raya Mobitor No. 123, Jakarta</p>
                <p class="text-gray-500 text-sm">Telp: 0812-0000-0001</p>
                <div class="mt-4">
                    <h2 class="text-lg font-bold text-gray-800">KWITANSI PEMBAYARAN</h2>
                    <p class="text-gray-500 text-sm">No. KWT-{{ str_pad($payment->id, 6, '0', STR_PAD_LEFT) }}</p>
                </div>
            </div>

            <div class="space-y-3 text-sm mb-6">
                <div class="flex justify-between">
                    <span class="text-gray-500">Tanggal</span>
                    <span class="font-semibold">{{ $payment->paid_at?->format('d M Y H:i') }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">Nama Pelanggan</span>
                    <span class="font-semibold">{{ $payment->rental->user->name }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">Kendaraan</span>
                    <span class="font-semibold">{{ $payment->rental->vehicle->name }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">Periode Sewa</span>
                    <span class="font-semibold">{{ $payment->rental->start_date->format('d M Y') }} - {{ $payment->rental->end_date->format('d M Y') }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">Total Hari</span>
                    <span class="font-semibold">{{ $payment->rental->total_days }} hari</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">Metode Bayar</span>
                    <span class="font-semibold capitalize">{{ $payment->method }}</span>
                </div>
            </div>

            <div class="border-t-2 border-gray-800 border-b-2 py-4 my-4 flex justify-between items-center">
                <span class="font-bold text-lg text-gray-800">TOTAL DIBAYAR</span>
                <span class="font-extrabold text-2xl text-primary">Rp {{ number_format($payment->amount, 0, ',', '.') }}</span>
            </div>

            <div class="flex justify-between items-end mt-8">
                <div>
                    <p class="text-xs text-gray-400">Dicetak oleh: {{ auth()->user()->name }}</p>
                    <p class="text-xs text-gray-400">{{ now()->format('d M Y H:i') }}</p>
                </div>
                <div class="text-center">
                    <div class="w-24 h-16 border-b border-gray-400 mb-1"></div>
                    <p class="text-xs text-gray-500">Tanda Tangan Staff</p>
                </div>
            </div>
        </div>

        <div class="text-center mt-4">
            <a href="{{ route('staff.payments.index') }}" class="text-gray-500 text-sm hover:text-primary">Kembali ke Pembayaran</a>
        </div>
    </div>
</x-dashboard-layout>
