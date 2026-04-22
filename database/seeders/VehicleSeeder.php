<?php

namespace Database\Seeders;

use App\Models\Vehicle;
use Illuminate\Database\Seeder;

class VehicleSeeder extends Seeder
{
    public function run(): void
    {
        $vehicles = [
            [
                'name' => 'Honda Beat', 'brand' => 'Honda', 'type' => 'motor', 'year' => 2022,
                'plate_number' => 'B 1234 ABC', 'price_per_day' => 75000, 'fuel_type' => 'Bensin',
                'transmission' => 'automatic', 'capacity' => 2,
                'description' => 'Motor matic irit bahan bakar, cocok untuk perjalanan dalam kota.',
                'image_url' => 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=800',
                'status' => 'available',
            ],
            [
                'name' => 'Yamaha NMAX', 'brand' => 'Yamaha', 'type' => 'motor', 'year' => 2023,
                'plate_number' => 'B 2345 BCD', 'price_per_day' => 100000, 'fuel_type' => 'Bensin',
                'transmission' => 'automatic', 'capacity' => 2,
                'description' => 'Skuter premium dengan fitur lengkap dan nyaman untuk perjalanan jauh.',
                'image_url' => 'https://images.unsplash.com/photo-1609630875171-b1321377ee65?w=800',
                'status' => 'available',
            ],
            [
                'name' => 'Honda Vario 125', 'brand' => 'Honda', 'type' => 'motor', 'year' => 2021,
                'plate_number' => 'B 3456 CDE', 'price_per_day' => 80000, 'fuel_type' => 'Bensin',
                'transmission' => 'automatic', 'capacity' => 2,
                'description' => 'Motor matic stylish dengan performa handal dan konsumsi bensin hemat.',
                'image_url' => 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=800',
                'status' => 'rented',
            ],
            [
                'name' => 'Kawasaki KLX 150', 'brand' => 'Kawasaki', 'type' => 'motor', 'year' => 2022,
                'plate_number' => 'B 4567 DEF', 'price_per_day' => 120000, 'fuel_type' => 'Bensin',
                'transmission' => 'manual', 'capacity' => 2,
                'description' => 'Motor trail tangguh untuk medan off-road dan petualangan alam.',
                'image_url' => 'https://images.unsplash.com/photo-1609630875171-b1321377ee65?w=800',
                'status' => 'available',
            ],
            [
                'name' => 'Honda Scoopy', 'brand' => 'Honda', 'type' => 'motor', 'year' => 2023,
                'plate_number' => 'B 5678 EFG', 'price_per_day' => 85000, 'fuel_type' => 'Bensin',
                'transmission' => 'automatic', 'capacity' => 2,
                'description' => 'Motor retro modern dengan desain cantik dan fitur modern.',
                'image_url' => 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=800',
                'status' => 'maintenance',
            ],
            [
                'name' => 'Toyota Avanza', 'brand' => 'Toyota', 'type' => 'mobil', 'year' => 2022,
                'plate_number' => 'B 6789 FGH', 'price_per_day' => 350000, 'fuel_type' => 'Bensin',
                'transmission' => 'manual', 'capacity' => 7,
                'description' => 'MPV keluarga yang luas dan nyaman, cocok untuk perjalanan bersama keluarga.',
                'image_url' => 'https://images.unsplash.com/photo-1533473359331-0135ef1b58bf?w=800',
                'status' => 'available',
            ],
            [
                'name' => 'Honda Brio', 'brand' => 'Honda', 'type' => 'mobil', 'year' => 2023,
                'plate_number' => 'B 7890 GHI', 'price_per_day' => 280000, 'fuel_type' => 'Bensin',
                'transmission' => 'automatic', 'capacity' => 5,
                'description' => 'City car compact yang gesit dan irit, ideal untuk mobilitas perkotaan.',
                'image_url' => 'https://images.unsplash.com/photo-1533473359331-0135ef1b58bf?w=800',
                'status' => 'available',
            ],
            [
                'name' => 'Suzuki Ertiga', 'brand' => 'Suzuki', 'type' => 'mobil', 'year' => 2021,
                'plate_number' => 'B 8901 HIJ', 'price_per_day' => 320000, 'fuel_type' => 'Bensin',
                'transmission' => 'automatic', 'capacity' => 7,
                'description' => 'MPV stylish dengan interior modern dan konsumsi bahan bakar efisien.',
                'image_url' => 'https://images.unsplash.com/photo-1533473359331-0135ef1b58bf?w=800',
                'status' => 'rented',
            ],
            [
                'name' => 'Mitsubishi Xpander', 'brand' => 'Mitsubishi', 'type' => 'mobil', 'year' => 2023,
                'plate_number' => 'B 9012 IJK', 'price_per_day' => 420000, 'fuel_type' => 'Bensin',
                'transmission' => 'automatic', 'capacity' => 7,
                'description' => 'MPV premium dengan desain elegan dan fitur keselamatan lengkap.',
                'image_url' => 'https://images.unsplash.com/photo-1533473359331-0135ef1b58bf?w=800',
                'status' => 'available',
            ],
            [
                'name' => 'Toyota Innova', 'brand' => 'Toyota', 'type' => 'mobil', 'year' => 2022,
                'plate_number' => 'B 0123 JKL', 'price_per_day' => 500000, 'fuel_type' => 'Solar',
                'transmission' => 'manual', 'capacity' => 8,
                'description' => 'MPV besar bermesin diesel yang tangguh untuk perjalanan jarak jauh.',
                'image_url' => 'https://images.unsplash.com/photo-1533473359331-0135ef1b58bf?w=800',
                'status' => 'available',
            ],
        ];

        foreach ($vehicles as $vehicle) {
            Vehicle::create($vehicle);
        }
    }
}
