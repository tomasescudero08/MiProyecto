<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug'];

    protected $table = 'categories';

    // Relación: Una categoría tiene muchas habitaciones
    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
}
