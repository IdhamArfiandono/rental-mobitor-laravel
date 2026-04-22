<x-app-layout>
    <x-slot name="title">Rental Mobitor - Kendaraan Terpercaya, Harga Terjangkau</x-slot>

    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-secondary via-blue-900 to-primary text-white overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-20 left-10 w-64 h-64 bg-accent rounded-full blur-3xl"></div>
            <div class="absolute bottom-10 right-10 w-96 h-96 bg-primary rounded-full blur-3xl"></div>
        </div>
        <div class="relative max-w-7xl mx-auto px-4 py-24 md:py-32">
            <div class="max-w-2xl">
                <span class="inline-block bg-accent text-secondary text-sm font-bold px-4 py-1 rounded-full mb-6">#1 Rental Kendaraan Terpercaya</span>
                <h1 class="text-4xl md:text-6xl font-extrabold leading-tight mb-6">
                    Rental Kendaraan<br>
                    <span class="text-accent">Terpercaya,</span><br>
                    Harga Terjangkau
                </h1>
                <p class="text-lg text-blue-200 mb-8 leading-relaxed">
                    Sewa motor dan mobil berkualitas dengan harga transparan. Armada terawat, proses mudah, dan layanan 24 jam siap membantu perjalanan Anda.
                </p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('catalog.index') }}"
                       class="bg-accent text-secondary font-bold px-8 py-4 rounded-xl text-center hover:bg-yellow-400 transition-colors text-lg">
                        Lihat Katalog
                    </a>
                    <a href="{{ route('register') }}"
                       class="border-2 border-white text-white font-bold px-8 py-4 rounded-xl text-center hover:bg-white hover:text-secondary transition-colors text-lg">
                        Daftar Sekarang
                    </a>
                </div>
                <div class="flex items-center gap-8 mt-10">
                    <div>
                        <p class="text-3xl font-extrabold text-accent">500+</p>
                        <p class="text-blue-300 text-sm">Pelanggan Puas</p>
                    </div>
                    <div class="w-px h-10 bg-blue-700"></div>
                    <div>
                        <p class="text-3xl font-extrabold text-accent">50+</p>
                        <p class="text-blue-300 text-sm">Armada Kendaraan</p>
                    </div>
                    <div class="w-px h-10 bg-blue-700"></div>
                    <div>
                        <p class="text-3xl font-extrabold text-accent">5+</p>
                        <p class="text-blue-300 text-sm">Tahun Berpengalaman</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Keunggulan Section -->
    <section class="max-w-7xl mx-auto px-4 py-20">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-extrabold text-secondary mb-4">Mengapa Pilih Rental Mobitor?</h2>
            <p class="text-gray-500 text-lg max-w-2xl mx-auto">Kami berkomitmen memberikan layanan rental kendaraan terbaik dengan standar kualitas tertinggi.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 text-center hover:shadow-md transition-shadow">
                <div class="w-14 h-14 bg-blue-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <svg class="w-7 h-7 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                </div>
                <h3 class="font-bold text-gray-800 text-lg mb-2">Armada Terawat</h3>
                <p class="text-gray-500 text-sm">Setiap kendaraan dirawat secara rutin dan diperiksa sebelum disewakan untuk keamanan Anda.</p>
            </div>
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 text-center hover:shadow-md transition-shadow">
                <div class="w-14 h-14 bg-green-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <svg class="w-7 h-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="font-bold text-gray-800 text-lg mb-2">Harga Transparan</h3>
                <p class="text-gray-500 text-sm">Tidak ada biaya tersembunyi. Harga yang tertera sudah final dan termasuk semua fasilitas dasar.</p>
            </div>
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 text-center hover:shadow-md transition-shadow">
                <div class="w-14 h-14 bg-yellow-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <svg class="w-7 h-7 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <h3 class="font-bold text-gray-800 text-lg mb-2">Antar Jemput</h3>
                <p class="text-gray-500 text-sm">Layanan antar jemput kendaraan ke lokasi Anda tersedia di area Jakarta dan sekitarnya.</p>
            </div>
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 text-center hover:shadow-md transition-shadow">
                <div class="w-14 h-14 bg-purple-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <svg class="w-7 h-7 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="font-bold text-gray-800 text-lg mb-2">24 Jam Siap</h3>
                <p class="text-gray-500 text-sm">Tim kami siap membantu Anda 24 jam sehari, 7 hari seminggu untuk kebutuhan darurat.</p>
            </div>
        </div>
    </section>

    <!-- Kendaraan Tersedia Section -->
    <section class="bg-gray-50 py-20">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-extrabold text-secondary mb-4">Kendaraan Tersedia</h2>
                <p class="text-gray-500 text-lg">Pilih dari berbagai armada motor dan mobil berkualitas kami</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($vehicles as $vehicle)
                    <x-vehicle-card :vehicle="$vehicle" />
                @endforeach
            </div>
            <div class="text-center mt-10">
                <a href="{{ route('catalog.index') }}"
                   class="inline-flex items-center gap-2 bg-primary text-white font-bold px-8 py-4 rounded-xl hover:bg-blue-700 transition-colors text-lg">
                    Lihat Semua Kendaraan
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Cara Sewa Section -->
    <section class="max-w-7xl mx-auto px-4 py-20">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-extrabold text-secondary mb-4">Cara Sewa Mudah</h2>
            <p class="text-gray-500 text-lg">4 langkah mudah untuk mendapatkan kendaraan impian Anda</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 relative">
            <div class="hidden md:block absolute top-8 left-1/4 right-1/4 h-0.5 bg-blue-100 z-0"></div>
            @php
                $steps = [
                    ['no' => '01', 'title' => 'Pilih Kendaraan', 'desc' => 'Jelajahi katalog dan pilih kendaraan yang sesuai kebutuhan dan budget Anda.', 'color' => 'bg-blue-600'],
                    ['no' => '02', 'title' => 'Daftar & Pesan', 'desc' => 'Buat akun, tentukan tanggal sewa, dan konfirmasi pemesanan Anda.', 'color' => 'bg-green-600'],
                    ['no' => '03', 'title' => 'Bayar & Konfirmasi', 'desc' => 'Lakukan pembayaran dan tunggu konfirmasi dari tim kami.', 'color' => 'bg-yellow-500'],
                    ['no' => '04', 'title' => 'Ambil & Nikmati', 'desc' => 'Ambil kendaraan di lokasi kami atau gunakan layanan antar jemput.', 'color' => 'bg-purple-600'],
                ];
            @endphp
            @foreach($steps as $step)
                <div class="text-center relative z-10">
                    <div class="w-16 h-16 {{ $step['color'] }} rounded-2xl flex items-center justify-center mx-auto mb-4 text-white font-extrabold text-xl shadow-lg">
                        {{ $step['no'] }}
                    </div>
                    <h3 class="font-bold text-gray-800 text-lg mb-2">{{ $step['title'] }}</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">{{ $step['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    <!-- Testimoni Section -->
    <section class="bg-secondary text-white py-20">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-extrabold mb-4">Apa Kata Pelanggan Kami</h2>
                <p class="text-blue-300 text-lg">Ribuan pelanggan telah mempercayakan perjalanan mereka kepada kami</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @php
                    $testimonials = [
                        ['name' => 'Ahmad Fauzi', 'role' => 'Pelanggan Setia', 'rating' => 5, 'text' => 'Pelayanan sangat memuaskan! Kendaraan bersih dan terawat. Proses sewa mudah dan cepat. Pasti akan sewa lagi untuk perjalanan berikutnya.'],
                        ['name' => 'Rina Kusuma', 'role' => 'Pelanggan Baru', 'rating' => 5, 'text' => 'Sangat puas dengan layanan Rental Mobitor. Harga terjangkau, kendaraan prima, dan staff sangat ramah dan profesional.'],
                        ['name' => 'Doni Pratama', 'role' => 'Pelanggan Setia', 'rating' => 5, 'text' => 'Sudah 3 kali sewa di sini, selalu puas. Prosesnya gampang lewat aplikasi, kendaraan selalu dalam kondisi bagus. Recommended!'],
                    ];
                @endphp
                @foreach($testimonials as $t)
                    <div class="bg-blue-900 rounded-2xl p-6 border border-blue-700">
                        <div class="flex items-center gap-1 mb-4">
                            @for($i = 0; $i < $t['rating']; $i++)
                                <svg class="w-5 h-5 text-accent" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                            @endfor
                        </div>
                        <p class="text-blue-100 text-sm leading-relaxed mb-6">"{{ $t['text'] }}"</p>
                        <div>
                            <p class="font-semibold text-white">{{ $t['name'] }}</p>
                            <p class="text-blue-400 text-sm">{{ $t['role'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="max-w-7xl mx-auto px-4 py-20">
        <div class="bg-gradient-to-r from-primary to-blue-700 rounded-3xl p-10 md:p-16 text-center text-white">
            <h2 class="text-3xl md:text-4xl font-extrabold mb-4">Siap Mulai Perjalanan?</h2>
            <p class="text-blue-100 text-lg mb-8 max-w-xl mx-auto">Daftar sekarang dan dapatkan kemudahan menyewa kendaraan kapan saja dan di mana saja.</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('register') }}"
                   class="bg-accent text-secondary font-bold px-8 py-4 rounded-xl hover:bg-yellow-400 transition-colors text-lg">
                    Daftar Gratis
                </a>
                <a href="{{ route('catalog.index') }}"
                   class="border-2 border-white text-white font-bold px-8 py-4 rounded-xl hover:bg-white hover:text-primary transition-colors text-lg">
                    Lihat Katalog
                </a>
            </div>
        </div>
    </section>

    <!-- Lokasi Section -->
    <section class="bg-gray-50 py-16">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-10">
                <h2 class="text-3xl font-extrabold text-secondary mb-4">Lokasi Kami</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                <div class="bg-white rounded-2xl p-8 shadow-sm">
                    <div class="space-y-4">
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-800">Alamat</p>
                                <p class="text-gray-500">Jl. Raya Mobitor No. 123, Kebayoran Baru, Jakarta Selatan 12180</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 bg-green-100 rounded-xl flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-800">Telepon</p>
                                <p class="text-gray-500">0812-0000-0001 (WhatsApp)</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 bg-yellow-100 rounded-xl flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-800">Jam Operasional</p>
                                <p class="text-gray-500">Senin - Minggu: 08.00 - 22.00 WIB</p>
                                <p class="text-gray-500">Layanan darurat: 24 jam</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-blue-100 rounded-2xl h-64 flex items-center justify-center">
                    <p class="text-blue-400 font-medium">Peta Lokasi</p>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
