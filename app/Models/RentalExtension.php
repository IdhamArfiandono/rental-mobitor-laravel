<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentalExtension extends Model
{
    use HasFactory;

    protected $fillable = ['rental_id', 'extended_days', 'additional_cost', 'reason'];

    public function rental()
    {
        return $this->belongsTo(Rental::class);
    }
}
