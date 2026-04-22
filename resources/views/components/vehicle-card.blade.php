@props(['vehicle'])
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md hover:-translate-y-1 transition-all duration-200">
    <div class="relative h-48 bg-gray-100 overflow-hidden">
        <img src="{{ $vehicle->image_url ?? 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=800' }}"
             alt="{{ $vehicle->name }}"
             class="w-full h-full object-cover">
        <span class="absolute top-3 left-3 px-2 py-1 rounded-full text-xs font-semibold
            {{ $vehicle->type === 'motor' ? 'bg-green-100 text-green-700' : 'bg-blue-100 text-blue-700' }}">
            {{ ucfirst($vehicle->type) }}
        </span>
    </div>
    <div class="p-4">
        <h3 class="font-bold text-gray-800 text-lg leading-tight">{{ $vehicle->name }}</h3>
        <p class="text-gray-500 text-sm mt-1">{{ $vehicle->brand }} &bull; {{ $vehicle->year }} &bull; {{ ucfirst($vehicle->transmission) }}</p>
        <p class="text-gray-400 text-xs mt-1">{{ $vehicle->capacity }} penumpang &bull; {{ $vehicle->fuel_type }}</p>
        <div class="mt-4 flex items-center justify-between">
            <div>
                <span class="text-primary font-bold text-xl">Rp {{ number_format($vehicle->price_per_day, 0, ',', '.') }}</span>
                <span class="text-gray-400 text-sm">/hari</span>
            </div>
            <a href="{{ route('catalog.show', $vehicle) }}"
               class="bg-primary text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-blue-700 transition-colors">
                Sewa Sekarang
            </a>
        </div>
    </div>
</div>
