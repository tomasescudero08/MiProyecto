<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::with(['room', 'service'])->latest()->paginate(10);
        return view('reviews.index', compact('reviews'));
    }

    public function store(Request $request)
    {
        // 1. Validar los datos recibidos del modal/formulario
        $request->validate([
            'guest_name'  => 'required|string|max:255',
            'guest_email' => 'nullable|email|max:255',
            'rating'      => 'required|integer|min:1|max:5',
            'comment'     => 'required|string',
        ]);

        // 2. Crear el registro en la base de datos
        Review::create([
            'guest_name'  => $request->guest_name,
            'guest_email' => $request->guest_email,
            'rating'      => $request->rating,
            'comment'     => $request->comment,
            'is_approved' => true, // Cambia a false si prefieres moderarla en el admin primero
        ]);

        // 3. Redireccionar de vuelta con un mensaje de éxito
        return back()->with('success', '¡Gracias! Tu reseña ha sido registrada correctamente.');
    }

    public function toggleApproval(Review $review)
    {
        $review->update(['is_approved' => !$review->is_approved]);
        return back()->with('success', 'Estado de la reseña actualizado.');
    }

    public function destroy(Review $review)
    {
        $review->delete();
        return back()->with('success', 'Reseña eliminada correctamente.');
    }

    // En app/Http/Controllers/ReviewController.php

    public function publicIndex()
    {
        $reviews = Review::where('is_approved', true)->with(['room', 'service'])->latest()->paginate(9);
        // Si guardaste el archivo como 'reviews-public.blade.php' directamente en resources/views/
        return view('public', compact('reviews'));
    }

    public function show(Review $review)
    {
        $review->load(['room', 'service']);
        return view('reviews.show', compact('review'));
    }
}
