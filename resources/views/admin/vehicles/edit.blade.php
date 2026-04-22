<x-dashboard-layout>
    <x-slot name="title">Edit Kendaraan</x-slot>

    <div class="max-w-3xl mx-auto">
        <div class="mb-4">
            <a href="{{ route('admin.vehicles.index') }}" class="inline-flex items-center gap-2 text-gray-500 hover:text-primary text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                Kembali
            </a>
        </div>
        <div class="bg-white rounded-2xl border border-gray-100 p-8">
            <h2 class="text-xl font-bold text-secondary mb-6">Edit: {{ $vehicle->name }}</h2>
            <form method="POST" action="{{ route('admin.vehicles.update', $vehicle) }}">
                @csrf @method('PUT')
                @include('admin.vehicles._form', ['vehicle' => $vehicle])
                <div class="flex gap-3 mt-8">
                    <a href="{{ route('admin.vehicles.index') }}" class="flex-1 text-center border border-gray-200 text-gray-600 font-semibold py-3 rounded-xl hover:bg-gray-50">Batal</a>
                    <button type="submit" class="flex-1 bg-primary text-white font-bold py-3 rounded-xl hover:bg-blue-700 transition-colors">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</x-dashboard-layout>
