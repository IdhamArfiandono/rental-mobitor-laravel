<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vehicle extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'brand', 'type', 'year', 'plate_number',
        'price_per_day', 'fuel_type', 'transmission', 'capacity',
        'description', 'image_url', 'status',
    ];

    public function rentals()
    {
        return $this->hasMany(Rental::class);
    }

    public function isAvailableOn(string $startDate, string $endDate, ?int $excludeRentalId = null): bool
    {
        $query = $this->rentals()
            ->whereNotIn('status', ['cancelled', 'completed'])
            ->where(function ($q) use ($startDate, $endDate) {
                $q->whereBetween('start_date', [$startDate, $endDate])
                  ->orWhereBetween('end_date', [$startDate, $endDate])
                  ->orWhere(function ($q2) use ($startDate, $endDate) {
                      $q2->where('start_date', '<=', $startDate)
                         ->where('end_date', '>=', $endDate);
                  });
            });

        if ($excludeRentalId) {
            $query->where('id', '!=', $excludeRentalId);
        }

        return $query->count() === 0;
    }
}
