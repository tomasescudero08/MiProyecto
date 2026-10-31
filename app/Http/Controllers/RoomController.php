<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Category;
use App\Models\Service;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;

class RoomController extends Controller
{
    // 1. Método para el CATÁLOGO PÚBLICO (Lo que ven los clientes sin iniciar sesión)
    public function catalogue()
    {
        $rooms = Room::with('category')->latest()->get();
        return view('catalogue', compact('rooms')); // Asegúrate de que tu vista se llame catalogue.blade.php o ajusta el nombre aquí
    }

    // 2. Método para la GESTIÓN DE ADMINISTRACIÓN (Tu rooms.index actual con paginación)
    public function index()
    {
        $rooms = Room::with('category')->get(); // O la paginación que uses para el CRUD
        $services = Service::all();             // <-- 1. Cargamos los servicios para la barra de navegación
        $reviews = Review::where('is_approved', true)->latest()->take(3)->get();

        // 2. Devolvemos la vista del panel de habitaciones (asegúrate de que sea rooms.index)
        return view('rooms.index', compact('rooms', 'services', 'reviews'));
    }

    /**
     * GET /rooms/create -> Mostrar formulario de creación
     */
    public function create()
    {
        $categories = Category::all();
        $services = Service::all();

        return view('rooms.create', compact('categories', 'services'));
    }

    /**
     * POST /rooms -> Guardar la nueva habitación
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id'     => 'required|exists:categories,id',
            'title'           => 'required|string|max:150',
            'short_description' => 'nullable|string|max:255',
            'description'     => 'required|string',
            'price_per_night' => 'required|numeric|min:0',
            'capacity'        => 'required|integer|min:1',
            'image_url'       => 'nullable|string',
        ]);

        $room = Room::create([
            'category_id'       => $request->category_id,
            'title'             => $request->title,
            'slug'              => Str::slug($request->title),
            'badge_tag'         => $request->badge_tag,
            'short_description' => $request->short_description,
            'description'       => $request->description,
            'price_per_night'   => $request->price_per_night,
            'capacity'          => $request->capacity,
            'rating'            => $request->rating ?? 5.0,
            'image_url'         => $request->image_url,
            'is_active'         => $request->has('is_active'),
        ]);

        if ($request->has('services')) {
            $room->services()->sync($request->services);
        }

        return redirect()->route('rooms.index')->with('success', 'Habitación creada con éxito.');
    }

    /**
     * GET /rooms/{room} -> Ver una habitación específica
     */
    public function show(Room $room)
    {
        $room->load('category', 'services');
        return view('rooms.show', compact('room'));
    }

    /**
     * GET /rooms/{room}/edit -> Mostrar formulario de edición
     */
    public function edit(Room $room)
    {
        $categories = Category::all();
        $services = Service::all();
        return view('rooms.edit', compact('room', 'categories', 'services'));
    }

    /**
     * PUT /rooms/{room} -> Guardar los cambios
     */
    public function update(Request $request, Room $room)
    {
        $request->validate([
            'category_id'     => 'required|exists:categories,id',
            'title'           => 'required|string|max:150',
            'short_description' => 'nullable|string|max:255',
            'description'     => 'required|string',
            'price_per_night' => 'required|numeric|min:0',
            'capacity'        => 'required|integer|min:1',
            'image_url'       => 'nullable|string',
        ]);

        $room->update([
            'category_id'       => $request->category_id,
            'title'             => $request->title,
            'slug'              => Str::slug($request->title),
            'badge_tag'         => $request->badge_tag,
            'short_description' => $request->short_description,
            'description'       => $request->description,
            'price_per_night'   => $request->price_per_night,
            'capacity'          => $request->capacity,
            'rating'            => $request->rating ?? $room->rating,
            'image_url'         => $request->image_url,
            'is_active'         => $request->has('is_active'),
        ]);

        if ($request->has('services')) {
            $room->services()->sync($request->services);
        } else {
            $room->services()->detach();
        }

        return redirect()->route('rooms.index')->with('success', 'Habitación actualizada con éxito.');
    }

    /**
     * DELETE /rooms/{room} -> Eliminar
     */
    public function destroy(Room $room)
    {
        $room->services()->detach(); // Limpia la tabla pivote antes de borrar
        $room->delete();

        return redirect()->route('rooms.index')->with('success', 'Habitación eliminada con éxito.');
    }

    public function home()
    {
        // Consulta de habitaciones para el Home
        $rooms = Room::take(3)->get();

        // 1. Obtener los servicios para la sección de servicios
        $services = Service::take(3)->get(); // o Service::all(); según prefieras

        // 2. Obtener las reseñas aprobadas
        $reviews = Review::where('is_approved', true)->latest()->take(3)->get();

        // 3. Pasar las 3 variables necesarias a la vista home
        return view('home', compact('rooms', 'services', 'reviews'));
    }
}
