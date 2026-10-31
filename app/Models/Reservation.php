<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $table = 'reservations'; // Forzar el nombre exacto de la tabla

    protected $fillable = [
        'room_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'check_in',
        'check_out',
        'total_price',
        'status',
        'special_requests',
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
