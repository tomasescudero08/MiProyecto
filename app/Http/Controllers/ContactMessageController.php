<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    // Muestra la vista pública del formulario de contacto
    public function create()
    {
        return view('contactus');
    }

    // Guarda el mensaje enviado desde la web
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string|max:2000',
        ]);

        ContactMessage::create($request->all());

        return back()->with('success', '¡Gracias por contactarnos! Tu mensaje ha sido enviado correctamente.');
    }

    // Muestra la bandeja de entrada (Admin)
    public function index()
    {
        $messages = ContactMessage::latest()->get();
        return view('contact_messages.index', compact('messages'));
    }

    // Muestra el detalle del mensaje
    public function show(ContactMessage $contactMessage)
    {
        return view('contact_messages.show', compact('contactMessage'));
    }

    // Elimina el mensaje
    public function destroy(ContactMessage $contactMessage)
    {
        $contactMessage->delete();
        return back()->with('success', 'El mensaje ha sido eliminado.');
    }
}
