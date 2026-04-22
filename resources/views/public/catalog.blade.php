<x-app-layout>
    <x-slot name="title">Katalog Kendaraan - Rental Mobitor</x-slot>

    <div class="bg-secondary text-white py-12">
        <div class="max-w-7xl mx-auto px-4">
            <h1 class="text-3xl md:text-4xl font-extrabold mb-2">Katalog Kendaraan</h1>
            <p class="text-blue-300">Pilih kendaraan yang tersedia sesuai kebutuhan Anda</p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 py-10">
        <!-- Filter -->
        <form method="GET" action="{{ route('catalog.index') }}"
              class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Tipe Kendaraan</label>
                    <select name="type" class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-gray-700 focus:outline-none focus:ring-2 focus:ring-primary">
                        <option value="">Semua Tipe</option>
                        <option value="motor" {{ request('type') === 'motor' ? 'selected' : '' }}>Motor</option>
                        <option value="mobil" {{ request('type') === 'mobil' ? 'selected' : '' }}>Mobil</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Transmisi</label>
                    <select name="transmission" class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-gray-700 focus:outline-none focus:ring-2 focus:ring-primary">
                        <option value="">Semua Transmisi</option>
                        <option value="automatic" {{ request('transmission') === 'automatic' ? 'selected' : '' }}>Automatic</option>
                        <option value="manual" {{ request('transmission') === 'manual' ? 'selected' : '' }}>Manual</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Harga Maksimal</label>
                    <select name="max_price" class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-gray-700 focus:outline-none focus:ring-2 focus:ring-primary">
                        <option value="">Semua Harga</option>
                        <option value="100000" {{ request('max_price') == '100000' ? 'selected' : '' }}>s/d Rp 100.000</option>
                        <option value="200000" {{ request('max_price') == '200000' ? 'selected' : '' }}>s/d Rp 200.000</option>
                        <option value="350000" {{ request('max_price') == '350000' ? 'selected' : '' }}>s/d Rp 350.000</option>
                        <option value="500000" {{ request('max_price') == '500000' ? 'selected' : '' }}>s/d Rp 500.000</option>
                    </select>
                </div>
                <div class="flex gap-2">
                    <button type="submit" class="flex-1 bg-primary text-white font-semibold py-2.5 px-4 rounded-lg hover:bg-blue-700 transition-colors">
                        Filter
                    </button>
                    <a href="{{ route('catalog.index') }}" class="px-4 py-2.5 border border-gray-200 rounded-lg text-gray-600 hover:bg-gray-50 transition-colors">
                        Reset
                    </a>
                </div>
            </div>
        </form>

        <!-- Results -->
        <div class="flex items-center justify-between mb-6">
            <p class="text-gray-500">
                Menampilkan <span class="font-semibold text-gray-800">{{ $vehicles->total() }}</span> kendaraan tersedia
            </p>
        </div>

        @if($vehicles->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($vehicles as $vehicle)
                    <x-vehicle-card :vehicle="$vehicle" />
                @endforeach
            </div>
            <div class="mt-8">
                {{ $vehicles->links() }}
            </div>
        @else
            <div class="text-center py-20">
                <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-700 mb-2">Tidak Ada Kendaraan</h3>
                <p class="text-gray-500">Tidak ada kendaraan yang tersedia dengan filter yang dipilih.</p>
                <a href="{{ route('catalog.index') }}" class="inline-block mt-4 text-primary font-semibold hover:underline">Reset filter</a>
            </div>
        @endif
    </div>
</x-app-layout>
