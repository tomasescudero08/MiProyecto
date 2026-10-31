<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ContactMessageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Rutas Públicas (Catálogo abierto para todos los visitantes)
|--------------------------------------------------------------------------
*/
Route::get('/', [RoomController::class, 'home'])->name('home');

// Catálogo público de habitaciones
Route::get('/catalogue', [RoomController::class, 'catalogue'])->name('catalogue');


// Catálogo público de servicios (Para los clientes)
Route::get('/services', [ServiceController::class, 'catalogue'])->name('services.catalogue');

Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');
Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
Route::patch('/reviews/{review}/toggle', [ReviewController::class, 'toggleApproval'])->name('reviews.toggle');
Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');



Route::get('/about-us', function () { return view('aboutus'); })->name('aboutus');

// Rutas públicas de Contacto (Formulario y envío)
Route::get('/contactus', [ContactMessageController::class, 'create'])->name('contactus');
Route::post('/contactus', [ContactMessageController::class, 'store'])->name('contact.store');

// Rutas públicas de Reservas (Crear, guardar y ver comprobante de éxito)
Route::get('/rooms/{room}/reserve', [ReservationController::class, 'create'])->name('reservations.create');
Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
Route::get('/reservations/{reservation}/success', [ReservationController::class, 'success'])->name('reservations.success');

/*
|--------------------------------------------------------------------------
| Rutas Protegidas (Solo para usuarios autenticados / Admin)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // 1. Gestión de Habitaciones ( Panel Admin - Excluimos 'show' para que sea pública )
    Route::resource('rooms', RoomController::class)->except(['show']);

    // 2. Gestión de Servicios (Panel Admin)
    Route::get('/admin/services', [ServiceController::class, 'index'])->name('services.index');
    Route::resource('services', ServiceController::class)->except(['index', 'show']);

    // --- OTRAS RUTAS DE GESTIÓN (ADMIN) ---

    // Reservas (CRUD del Administrador: index, destroy, etc.)
    Route::resource('reservations', ReservationController::class)->except(['create', 'store', 'show']);

    // Reseñas (Listar, guardar y eliminar)
    Route::get('/admin/reviews', [ReviewController::class, 'index'])->name('reviews.index');
    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
    Route::get('/reviews/{review}', [ReviewController::class, 'show'])->name('reviews.show');

    // Bandeja de Mensajes de Contacto (Admin)
    Route::resource('contact_messages', ContactMessageController::class)->only(['index', 'show', 'destroy']);

    // Perfil de usuario (Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Vistas exclusivas del Panel Admin para reservas
    Route::get('/admin/reservations', [ReservationController::class, 'index'])->name('reservations.index');
    Route::delete('/admin/reservations/{reservation}', [ReservationController::class, 'destroy'])->name('reservations.destroy');
});

Route::get('/rooms/{room}', [RoomController::class, 'show'])->name('rooms.show');
Route::get('/services/{service}', [ServiceController::class, 'show'])->name('services.show');
Route::get('/opiniones', [ReviewController::class, 'publicIndex'])->name('reviews.public');
require __DIR__.'/auth.php';
