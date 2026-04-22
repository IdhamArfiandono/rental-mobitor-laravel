<div class="grid grid-cols-1 md:grid-cols-2 gap-5">
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Kendaraan <span class="text-red-500">*</span></label>
        <input type="text" name="name" value="{{ old('name', $vehicle->name ?? '') }}" required
               class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary">
        @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
    </div>
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-2">Brand <span class="text-red-500">*</span></label>
        <input type="text" name="brand" value="{{ old('brand', $vehicle->brand ?? '') }}" required
               class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary">
        @error('brand')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
    </div>
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-2">Tipe <span class="text-red-500">*</span></label>
        <select name="type" required class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary">
            <option value="motor" {{ old('type', $vehicle->type ?? '') === 'motor' ? 'selected' : '' }}>Motor</option>
            <option value="mobil" {{ old('type', $vehicle->type ?? '') === 'mobil' ? 'selected' : '' }}>Mobil</option>
        </select>
        @error('type')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
    </div>
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-2">Tahun <span class="text-red-500">*</span></label>
        <input type="number" name="year" value="{{ old('year', $vehicle->year ?? date('Y')) }}" min="1990" max="{{ date('Y')+1 }}" required
               class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary">
        @error('year')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
    </div>
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-2">Plat Nomor <span class="text-red-500">*</span></label>
        <input type="text" name="plate_number" value="{{ old('plate_number', $vehicle->plate_number ?? '') }}" required
               class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary">
        @error('plate_number')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
    </div>
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-2">Harga per Hari (Rp) <span class="text-red-500">*</span></label>
        <input type="number" name="price_per_day" value="{{ old('price_per_day', $vehicle->price_per_day ?? '') }}" min="1000" required
               class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary">
        @error('price_per_day')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
    </div>
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-2">Bahan Bakar <span class="text-red-500">*</span></label>
        <input type="text" name="fuel_type" value="{{ old('fuel_type', $vehicle->fuel_type ?? '') }}" placeholder="Bensin / Solar / Listrik" required
               class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary">
        @error('fuel_type')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
    </div>
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-2">Transmisi <span class="text-red-500">*</span></label>
        <select name="transmission" required class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary">
            <option value="automatic" {{ old('transmission', $vehicle->transmission ?? '') === 'automatic' ? 'selected' : '' }}>Automatic</option>
            <option value="manual" {{ old('transmission', $vehicle->transmission ?? '') === 'manual' ? 'selected' : '' }}>Manual</option>
        </select>
        @error('transmission')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
    </div>
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-2">Kapasitas (penumpang) <span class="text-red-500">*</span></label>
        <input type="number" name="capacity" value="{{ old('capacity', $vehicle->capacity ?? '') }}" min="1" max="20" required
               class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary">
        @error('capacity')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
    </div>
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-2">Status</label>
        <select name="status" class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary">
            <option value="available" {{ old('status', $vehicle->status ?? 'available') === 'available' ? 'selected' : '' }}>Tersedia</option>
            <option value="rented" {{ old('status', $vehicle->status ?? '') === 'rented' ? 'selected' : '' }}>Disewa</option>
            <option value="maintenance" {{ old('status', $vehicle->status ?? '') === 'maintenance' ? 'selected' : '' }}>Perawatan</option>
        </select>
        @error('status')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
    </div>
</div>
<div class="mt-5">
    <label class="block text-sm font-semibold text-gray-700 mb-2">URL Foto</label>
    <input type="url" name="image_url" value="{{ old('image_url', $vehicle->image_url ?? '') }}"
           placeholder="https://..."
           class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary">
    @error('image_url')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
</div>
<div class="mt-5">
    <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi</label>
    <textarea name="description" rows="3"
              class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary resize-none">{{ old('description', $vehicle->description ?? '') }}</textarea>
    @error('description')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
</div>
