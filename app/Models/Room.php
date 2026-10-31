<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'badge_tag',
        'description',
        'short_description',
        'price_per_night',
        'capacity',
        'rating',
        'image_url',
        'is_active',
    ];

    // Relación: Una habitación pertenece a una categoría
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relación: Una habitación puede tener muchos servicios (Muchos a Muchos)
    public function services()
    {
        return $this->belongsToMany(Service::class, 'room_service');
    }
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
