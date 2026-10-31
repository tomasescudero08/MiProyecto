<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'guest_name',
        'guest_email',
        'rating',
        'comment',
        'is_approved',
        'room_id',
        'service_id',
    ];

    // Relaciones (opcionales)
    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
