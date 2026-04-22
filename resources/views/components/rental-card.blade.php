@props(['rental'])
@php
    $statusColor = match($rental->status) {
        'pending' => 'bg-yellow-100 text-yellow-700',
        'confirmed' => 'bg-blue-100 text-blue-700',
        'ongoing' => 'bg-green-100 text-green-700',
        'completed' => 'bg-gray-100 text-gray-600',
        'cancelled' => 'bg-red-100 text-red-700',
        default => 'bg-gray-100 text-gray-700',
    };
    $statusLabel = match($rental->status) {
        'pending' => 'Menunggu',
        'confirmed' => 'Dikonfirmasi',
        'ongoing' => 'Berlangsung',
        'completed' => 'Selesai',
        'cancelled' => 'Dibatalkan',
        default => ucfirst($rental->status),
    };
@endphp
<div class="bg-white rounded-xl border border-gray-100 p-4 flex items-center gap-4 hover:shadow-sm transition-shadow">
    <div class="w-16 h-16 rounded-lg overflow-hidden bg-gray-100 flex-shrink-0">
        <img src="{{ $rental->vehicle->image_url ?? 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=400' }}"
             alt="{{ $rental->vehicle->name }}"
             class="w-full h-full object-cover">
    </div>
    <div class="flex-1 min-w-0">
        <h4 class="font-semibold text-gray-800 truncate">{{ $rental->vehicle->name }}</h4>
        <p class="text-sm text-gray-500">{{ $rental->start_date->format('d M Y') }} - {{ $rental->end_date->format('d M Y') }}</p>
        <p class="text-sm font-semibold text-primary">Rp {{ number_format($rental->total_price, 0, ',', '.') }}</p>
    </div>
    <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $statusColor }} flex-shrink-0">{{ $statusLabel }}</span>
</div>
