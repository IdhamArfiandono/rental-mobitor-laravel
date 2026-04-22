<x-app-layout>
    <x-slot name="title">{{ $vehicle->name }} - Rental Mobitor</x-slot>

    <div class="max-w-7xl mx-auto px-4 py-10">
        <!-- Breadcrumb -->
        <nav class="flex items-center gap-2 text-sm text-gray-500 mb-6">
            <a href="{{ route('home') }}" class="hover:text-primary">Beranda</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <a href="{{ route('catalog.index') }}" class="hover:text-primary">Katalog</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <span class="text-gray-800 font-medium">{{ $vehicle->name }}</span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
            <!-- Foto -->
            <div>
                <div class="rounded-2xl overflow-hidden bg-gray-100 aspect-video">
                    <img src="{{ $vehicle->image_url ?? 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=800' }}"
                         alt="{{ $vehicle->name }}"
                         class="w-full h-full object-cover">
                </div>
                <div class="mt-4 grid grid-cols-3 gap-3">
                    @for($i = 0; $i < 3; $i++)
                        <div class="rounded-xl overflow-hidden bg-gray-100 aspect-video opacity-60">
                            <img src="{{ $vehicle->image_url ?? 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=400' }}"
                                 alt="{{ $vehicle->name }}"
                                 class="w-full h-full object-cover">
                        </div>
                    @endfor
                </div>
            </div>

            <!-- Detail -->
            <div>
                <div class="flex items-center gap-3 mb-3">
                    <span class="px-3 py-1 rounded-full text-sm font-semibold
                        {{ $vehicle->type === 'motor' ? 'bg-green-100 text-green-700' : 'bg-blue-100 text-blue-700' }}">
                        {{ ucfirst($vehicle->type) }}
                    </span>
                    <span class="px-3 py-1 rounded-full text-sm font-semibold
                        {{ $vehicle->status === 'available' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                        {{ $vehicle->status === 'available' ? 'Tersedia' : 'Tidak Tersedia' }}
                    </span>
                </div>

                <h1 class="text-3xl font-extrabold text-secondary mb-1">{{ $vehicle->name }}</h1>
                <p class="text-gray-500 mb-6">{{ $vehicle->brand }} &bull; {{ $vehicle->year }}</p>

                <div class="bg-blue-50 rounded-2xl p-6 mb-6">
                    <p class="text-gray-500 text-sm mb-1">Harga Sewa</p>
                    <p class="text-4xl font-extrabold text-primary">Rp {{ number_format($vehicle->price_per_day, 0, ',', '.') }}</p>
                    <p class="text-gray-500 text-sm">per hari</p>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div class="bg-gray-50 rounded-xl p-4">
                        <p class="text-gray-500 text-xs mb-1">Transmisi</p>
                        <p class="font-semibold text-gray-800 capitalize">{{ $vehicle->transmission }}</p>
                    </div>
                    <div class="bg-gray-50 rounded-xl p-4">
                        <p class="text-gray-500 text-xs mb-1">Bahan Bakar</p>
                        <p class="font-semibold text-gray-800">{{ $vehicle->fuel_type }}</p>
                    </div>
                    <div class="bg-gray-50 rounded-xl p-4">
                        <p class="text-gray-500 text-xs mb-1">Kapasitas</p>
                        <p class="font-semibold text-gray-800">{{ $vehicle->capacity }} Penumpang</p>
                    </div>
                    <div class="bg-gray-50 rounded-xl p-4">
                        <p class="text-gray-500 text-xs mb-1">Plat Nomor</p>
                        <p class="font-semibold text-gray-800">{{ $vehicle->plate_number }}</p>
                    </div>
                </div>

                @if($vehicle->description)
                    <div class="mb-6">
                        <h3 class="font-semibold text-gray-800 mb-2">Deskripsi</h3>
                        <p class="text-gray-500 leading-relaxed">{{ $vehicle->description }}</p>
                    </div>
                @endif

                @if($vehicle->status === 'available')
                    @auth
                        @if(auth()->user()->isPelanggan())
                            <a href="{{ route('customer.rentals.create', ['vehicle_id' => $vehicle->id]) }}"
                               class="block w-full text-center bg-primary text-white font-bold py-4 rounded-xl hover:bg-blue-700 transition-colors text-lg">
                                Sewa Sekarang
                            </a>
                        @else
                            <p class="text-gray-500 text-sm text-center">Fitur sewa hanya tersedia untuk pelanggan.</p>
                        @endif
                    @else
                        <a href="{{ route('login') }}"
                           class="block w-full text-center bg-primary text-white font-bold py-4 rounded-xl hover:bg-blue-700 transition-colors text-lg">
                            Masuk untuk Menyewa
                        </a>
                        <p class="text-center text-gray-500 text-sm mt-3">
                            Belum punya akun? <a href="{{ route('register') }}" class="text-primary font-semibold">Daftar gratis</a>
                        </p>
                    @endauth
                @else
                    <div class="bg-red-50 border border-red-200 rounded-xl py-4 px-6 text-center">
                        <p class="text-red-600 font-semibold">Kendaraan tidak tersedia saat ini</p>
                        <a href="{{ route('catalog.index') }}" class="text-primary text-sm mt-1 hover:underline">Lihat kendaraan lain</a>
                    </div>
                @endif
            </div>
        </div>

        <!-- Kendaraan Serupa -->
        @if($similar->count() > 0)
            <div class="mt-16">
                <h2 class="text-2xl font-extrabold text-secondary mb-6">Kendaraan Serupa</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($similar as $s)
                        <x-vehicle-card :vehicle="$s" />
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</x-app-layout>
