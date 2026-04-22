<x-dashboard-layout>
    <x-slot name="title">Profil Saya</x-slot>

    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
            <div class="flex items-center gap-4 mb-8">
                <div class="w-16 h-16 bg-primary rounded-full flex items-center justify-center text-white font-extrabold text-2xl">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div>
                    <h2 class="text-xl font-bold text-secondary">{{ auth()->user()->name }}</h2>
                    <p class="text-gray-500">Pelanggan sejak {{ auth()->user()->created_at->format('M Y') }}</p>
                </div>
            </div>

            <form method="POST" action="{{ route('customer.profile.update') }}">
                @csrf
                @method('PUT')

                <div class="space-y-5">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}"
                               class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary">
                        @error('name')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}"
                               class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary">
                        @error('email')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Nomor Telepon</label>
                        <input type="text" name="phone" value="{{ old('phone', $user->phone) }}"
                               placeholder="081234567890"
                               class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary">
                        @error('phone')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div class="border-t border-gray-100 pt-5">
                        <h3 class="font-semibold text-gray-700 mb-4">Ubah Password <span class="text-gray-400 font-normal">(opsional)</span></h3>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Password Baru</label>
                                <input type="password" name="password"
                                       placeholder="Minimal 8 karakter"
                                       class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary">
                                @error('password')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation"
                                       placeholder="Ulangi password baru"
                                       class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-8">
                    <button type="submit"
                            class="w-full bg-primary text-white font-bold py-3 rounded-xl hover:bg-blue-700 transition-colors">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-dashboard-layout>
