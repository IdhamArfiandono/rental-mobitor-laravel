<nav class="bg-white shadow-sm sticky top-0 z-50" x-data="{ open: false }">
    <div class="max-w-7xl mx-auto px-4 py-4 flex items-center justify-between">
        <a href="{{ route('home') }}" class="text-2xl font-extrabold text-primary">
            Rental <span class="text-accent">Mobitor</span>
        </a>
        <div class="hidden md:flex items-center gap-6">
            <a href="{{ route('home') }}" class="text-gray-600 hover:text-primary font-medium transition-colors {{ request()->routeIs('home') ? 'text-primary' : '' }}">Beranda</a>
            <a href="{{ route('catalog.index') }}" class="text-gray-600 hover:text-primary font-medium transition-colors {{ request()->routeIs('catalog*') ? 'text-primary' : '' }}">Katalog</a>
            @auth
                <a href="{{ route('dashboard') }}" class="bg-primary text-white px-4 py-2 rounded-lg font-semibold hover:bg-blue-700 transition-colors">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="text-gray-600 hover:text-primary font-medium transition-colors">Masuk</a>
                <a href="{{ route('register') }}" class="bg-primary text-white px-4 py-2 rounded-lg font-semibold hover:bg-blue-700 transition-colors">Daftar</a>
            @endauth
        </div>
        <button @click="open = !open" class="md:hidden text-gray-500 hover:text-gray-700">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>
    <div x-show="open" x-transition class="md:hidden px-4 pb-4 flex flex-col gap-3 border-t border-gray-100">
        <a href="{{ route('home') }}" class="text-gray-600 py-2">Beranda</a>
        <a href="{{ route('catalog.index') }}" class="text-gray-600 py-2">Katalog</a>
        @auth
            <a href="{{ route('dashboard') }}" class="text-primary font-semibold py-2">Dashboard</a>
        @else
            <a href="{{ route('login') }}" class="text-gray-600 py-2">Masuk</a>
            <a href="{{ route('register') }}" class="text-primary font-semibold py-2">Daftar</a>
        @endauth
    </div>
</nav>
