<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Service;
use App\Models\Review;
use Illuminate\Routing\Controller;

class HomeController extends Controller
{
    public function index()
    {
        // 1. Obtenemos las habitaciones activas para mostrarlas en el home (ej. las primeras 3)
        $rooms = Room::with('category')->where('is_active', true)->take(3)->get();

        // 2. Obtenemos los servicios marcados como destacados para el home
        $services = Service::where('is_featured', true)->get();

        $reviews = Review::where('is_approved', true)->latest()->take(3)->get();

        // 3. Enviamos ambas variables a la vista 'home.blade.php'
        return view('home', compact('rooms', 'services', 'reviews'));

        // Ejemplo en HomeController o RoomController (método home)

    }
}
