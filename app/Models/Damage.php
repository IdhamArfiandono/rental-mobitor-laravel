<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Damage extends Model
{
    use HasFactory;

    protected $fillable = ['rental_id', 'description', 'repair_cost'];

    public function rental()
    {
        return $this->belongsTo(Rental::class);
    }
}
