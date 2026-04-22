<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'vehicle_id', 'staff_id', 'start_date', 'end_date',
        'total_days', 'total_price', 'deposit', 'status', 'notes',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function staff()
    {
        return $this->belongsTo(User::class, 'staff_id');
    }

    public function extensions()
    {
        return $this->hasMany(RentalExtension::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function damages()
    {
        return $this->hasMany(Damage::class);
    }
}
