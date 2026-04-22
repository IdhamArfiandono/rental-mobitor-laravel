<?php

namespace Database\Seeders;

use App\Models\Damage;
use App\Models\Payment;
use App\Models\Rental;
use Illuminate\Database\Seeder;

class RentalSeeder extends Seeder
{
    public function run(): void
    {
        $rentals = [
            ['user_id' => 3, 'vehicle_id' => 1, 'staff_id' => 2, 'start_date' => now()->subDays(5), 'end_date' => now()->subDays(2), 'total_days' => 3, 'total_price' => 225000, 'deposit' => 100000, 'status' => 'completed', 'notes' => null],
            ['user_id' => 4, 'vehicle_id' => 6, 'staff_id' => 2, 'start_date' => now()->subDays(3), 'end_date' => now()->addDays(1), 'total_days' => 4, 'total_price' => 1400000, 'deposit' => 300000, 'status' => 'ongoing', 'notes' => 'Antar ke hotel'],
            ['user_id' => 5, 'vehicle_id' => 3, 'staff_id' => 2, 'start_date' => now()->subDays(2), 'end_date' => now()->addDays(2), 'total_days' => 4, 'total_price' => 320000, 'deposit' => 100000, 'status' => 'ongoing', 'notes' => null],
            ['user_id' => 6, 'vehicle_id' => 8, 'staff_id' => null, 'start_date' => now()->addDays(2), 'end_date' => now()->addDays(5), 'total_days' => 3, 'total_price' => 960000, 'deposit' => 200000, 'status' => 'confirmed', 'notes' => 'Perlu GPS'],
            ['user_id' => 7, 'vehicle_id' => 2, 'staff_id' => null, 'start_date' => now()->addDays(1), 'end_date' => now()->addDays(3), 'total_days' => 2, 'total_price' => 200000, 'deposit' => 100000, 'status' => 'pending', 'notes' => null],
            ['user_id' => 3, 'vehicle_id' => 7, 'staff_id' => 2, 'start_date' => now()->subDays(10), 'end_date' => now()->subDays(7), 'total_days' => 3, 'total_price' => 840000, 'deposit' => 200000, 'status' => 'completed', 'notes' => null],
            ['user_id' => 4, 'vehicle_id' => 4, 'staff_id' => null, 'start_date' => now()->addDays(3), 'end_date' => now()->addDays(6), 'total_days' => 3, 'total_price' => 360000, 'deposit' => 100000, 'status' => 'pending', 'notes' => null],
            ['user_id' => 5, 'vehicle_id' => 9, 'staff_id' => 2, 'start_date' => now()->subDays(7), 'end_date' => now()->subDays(4), 'total_days' => 3, 'total_price' => 1260000, 'deposit' => 300000, 'status' => 'cancelled', 'notes' => 'Pembatalan mendadak'],
        ];

        foreach ($rentals as $data) {
            Rental::create($data);
        }

        Payment::create(['rental_id' => 1, 'amount' => 225000, 'method' => 'cash', 'status' => 'paid', 'paid_at' => now()->subDays(5)]);
        Payment::create(['rental_id' => 2, 'amount' => 1400000, 'method' => 'transfer', 'status' => 'pending', 'paid_at' => null]);
        Payment::create(['rental_id' => 3, 'amount' => 320000, 'method' => 'cash', 'status' => 'pending', 'paid_at' => null]);
        Payment::create(['rental_id' => 4, 'amount' => 960000, 'method' => 'transfer', 'status' => 'pending', 'paid_at' => null]);
        Payment::create(['rental_id' => 6, 'amount' => 840000, 'method' => 'transfer', 'status' => 'paid', 'paid_at' => now()->subDays(10)]);

        Damage::create(['rental_id' => 1, 'description' => 'Goresan kecil pada spion kiri', 'repair_cost' => 50000]);
    }
}
