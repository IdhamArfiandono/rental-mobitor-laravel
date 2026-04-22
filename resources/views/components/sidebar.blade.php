@php
    $role = auth()->user()->role ?? 'pelanggan';
    $navItems = match($role) {
        'admin' => [
            ['label' => 'Dashboard', 'route' => 'admin.dashboard', 'pattern' => 'admin.dashboard', 'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'],
            ['label' => 'Kendaraan', 'route' => 'admin.vehicles.index', 'pattern' => 'admin.vehicles*', 'icon' => 'M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4'],
            ['label' => 'Pengguna', 'route' => 'admin.users.index', 'pattern' => 'admin.users*', 'icon' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z'],
            ['label' => 'Laporan', 'route' => 'admin.reports.index', 'pattern' => 'admin.reports*', 'icon' => 'M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'],
        ],
        'staff' => [
            ['label' => 'Dashboard', 'route' => 'staff.dashboard', 'pattern' => 'staff.dashboard', 'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'],
            ['label' => 'Kelola Rental', 'route' => 'staff.rentals.index', 'pattern' => 'staff.rentals*', 'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2'],
            ['label' => 'Pembayaran', 'route' => 'staff.payments.index', 'pattern' => 'staff.payments*', 'icon' => 'M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z'],
            ['label' => 'Kendaraan', 'route' => 'staff.vehicles.index', 'pattern' => 'staff.vehicles*', 'icon' => 'M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4'],
        ],
        default => [
            ['label' => 'Dashboard', 'route' => 'customer.dashboard', 'pattern' => 'customer.dashboard', 'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'],
            ['label' => 'Sewa Kendaraan', 'route' => 'catalog.index', 'pattern' => 'catalog*', 'icon' => 'M12 4v16m8-8H4'],
            ['label' => 'Riwayat Rental', 'route' => 'customer.rentals.index', 'pattern' => 'customer.rentals*', 'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2'],
            ['label' => 'Profil Saya', 'route' => 'customer.profile.edit', 'pattern' => 'customer.profile*', 'icon' => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z'],
        ],
    };
@endphp

<aside class="w-64 bg-secondary text-white flex flex-col fixed inset-y-0 left-0 z-40 transform transition-transform duration-200 ease-in-out"
    :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'">
    <div class="p-6 border-b border-blue-800">
        <a href="{{ route('home') }}" class="block">
            <span class="text-xl font-extrabold">Rental <span class="text-accent">Mobitor</span></span>
        </a>
        <p class="text-xs text-blue-300 mt-1 capitalize">Panel {{ $role }}</p>
    </div>
    <nav class="flex-1 p-4 space-y-1 overflow-y-auto">
        @foreach($navItems as $item)
            <a href="{{ route($item['route']) }}"
               class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium transition-colors
               {{ request()->routeIs($item['pattern']) ? 'bg-primary text-white' : 'text-blue-200 hover:bg-blue-800 hover:text-white' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $item['icon'] }}"/>
                </svg>
                {{ $item['label'] }}
            </a>
        @endforeach
    </nav>
    <div class="p-4 border-t border-blue-800">
        <div class="px-4 py-2 mb-2">
            <p class="text-sm font-medium text-white truncate">{{ auth()->user()->name }}</p>
            <p class="text-xs text-blue-300 truncate">{{ auth()->user()->email }}</p>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="flex items-center gap-3 w-full px-4 py-3 rounded-lg text-sm text-blue-200 hover:bg-blue-800 hover:text-white transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
                Keluar
            </button>
        </form>
    </div>
</aside>
