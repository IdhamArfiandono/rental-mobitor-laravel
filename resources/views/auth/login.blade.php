<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - Rental Mobitor</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>tailwind.config = { theme: { extend: { colors: { primary: '#2563eb', secondary: '#1e3a5f', accent: '#fbbf24' } } } }</script>
    <style> body { font-family: 'Plus Jakarta Sans', sans-serif; } </style>
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <div class="text-center mb-8">
            <a href="{{ route('home') }}" class="text-3xl font-extrabold text-primary">
                Rental <span class="text-accent">Mobitor</span>
            </a>
            <p class="text-gray-500 mt-2">Masuk ke akun Anda</p>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
            <x-auth-session-status class="mb-4 text-green-600 text-sm" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="space-y-5">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" required autofocus
                               class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary text-gray-800">
                        @error('email')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
                        <input type="password" name="password" required
                               class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary">
                        @error('password')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div class="flex items-center justify-between">
                        <label class="flex items-center gap-2 text-sm text-gray-600">
                            <input type="checkbox" name="remember" class="rounded border-gray-300">
                            Ingat saya
                        </label>
                        @if(Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-sm text-primary hover:underline">Lupa password?</a>
                        @endif
                    </div>
                </div>
                <button type="submit"
                        class="mt-6 w-full bg-primary text-white font-bold py-3 rounded-xl hover:bg-blue-700 transition-colors">
                    Masuk
                </button>
            </form>

            <div class="mt-6 text-center">
                <p class="text-gray-500 text-sm">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="text-primary font-semibold hover:underline">Daftar gratis</a>
                </p>
            </div>

            <div class="mt-6 pt-6 border-t border-gray-100">
                <p class="text-xs text-gray-400 text-center mb-3">Demo akun:</p>
                <div class="grid grid-cols-3 gap-2 text-xs text-gray-500">
                    <div class="bg-gray-50 rounded-lg p-2 text-center">
                        <p class="font-semibold text-gray-700">Admin</p>
                        <p>admin@rentalmobitor.com</p>
                        <p>admin123</p>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-2 text-center">
                        <p class="font-semibold text-gray-700">Staff</p>
                        <p>staff@rentalmobitor.com</p>
                        <p>staff123</p>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-2 text-center">
                        <p class="font-semibold text-gray-700">Pelanggan</p>
                        <p>budi@example.com</p>
                        <p>password</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mt-4">
            <a href="{{ route('home') }}" class="text-gray-400 text-sm hover:text-gray-600">Kembali ke Beranda</a>
        </div>
    </div>
</body>
</html>
