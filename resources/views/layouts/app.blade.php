<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Rental Mobitor' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { jakarta: ['"Plus Jakarta Sans"', 'sans-serif'] },
                    colors: { primary: '#2563eb', secondary: '#1e3a5f', accent: '#fbbf24' }
                }
            }
        }
    </script>
    <style> body { font-family: 'Plus Jakarta Sans', sans-serif; } </style>
</head>
<body class="bg-white text-gray-800">
    <x-navbar />
    <x-flash-message />
    <main>{{ $slot }}</main>
    <footer class="bg-secondary text-white py-12 mt-16">
        <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
                <h3 class="text-xl font-bold text-accent mb-3">Rental Mobitor</h3>
                <p class="text-gray-300 text-sm">Solusi rental kendaraan terpercaya dengan armada terawat dan harga transparan.</p>
            </div>
            <div>
                <h4 class="font-semibold mb-3">Navigasi</h4>
                <ul class="space-y-2 text-sm text-gray-300">
                    <li><a href="{{ route('home') }}" class="hover:text-accent">Beranda</a></li>
                    <li><a href="{{ route('catalog.index') }}" class="hover:text-accent">Katalog</a></li>
                    <li><a href="{{ route('login') }}" class="hover:text-accent">Masuk</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-semibold mb-3">Kontak</h4>
                <ul class="space-y-2 text-sm text-gray-300">
                    <li>Jl. Raya Mobitor No. 123, Jakarta</li>
                    <li>Telp: 0812-0000-0001</li>
                    <li>Email: info@rentalmobitor.com</li>
                    <li>Jam: 08.00 - 22.00 WIB</li>
                </ul>
            </div>
        </div>
        <div class="text-center text-gray-400 text-sm mt-8 border-t border-blue-800 pt-6">&copy; {{ date('Y') }} Rental Mobitor. All rights reserved.</div>
    </footer>
</body>
</html>
