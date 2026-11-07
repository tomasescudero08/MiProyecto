<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ContactMessageController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Mail\ReservationConfirmationMail;
use Illuminate\Support\Facades\Mail;

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

// Reseñas públicas
Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');
Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
Route::get('/opiniones', [ReviewController::class, 'publicIndex'])->name('reviews.public');

Route::get('/about-us', function () { return view('aboutus'); })->name('aboutus');

// Rutas públicas de Contacto (Formulario y envío)
Route::get('/contactus', [ContactMessageController::class, 'create'])->name('contactus');
Route::post('/contactus', [ContactMessageController::class, 'store'])->name('contact.store');

// Rutas públicas de Reservas (Crear, guardar y ver comprobante de éxito)
Route::get('/rooms/{room}/reserve', [ReservationController::class, 'create'])->name('reservations.create');
Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
Route::get('/reservations/{reservation}/success', [ReservationController::class, 'success'])->name('reservations.success');

// Detalles individuales públicos
Route::get('/rooms/{room}', [RoomController::class, 'show'])->name('rooms.show');
Route::get('/services/{service}', [ServiceController::class, 'show'])->name('services.show');


/*
|--------------------------------------------------------------------------
| Rutas para Usuarios Autenticados (Cualquier usuario registrado)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Perfil de usuario (Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


/*
|--------------------------------------------------------------------------
| Rutas Exclusivas para el Administrador (Protegidas con 'auth' y 'admin')
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->group(function () {

    // 1. Gestión de Habitaciones (Panel Admin - Excluimos 'show' que ya es pública)
    Route::resource('rooms', RoomController::class)->except(['show']);

    // 2. Gestión de Servicios (Panel Admin)
    Route::get('/admin/services', [ServiceController::class, 'index'])->name('services.index');
    Route::resource('services', ServiceController::class)->except(['index', 'show']);

    // 3. Reservas (CRUD del Administrador)
    Route::resource('reservations', ReservationController::class)->except(['create', 'store', 'show']);
    Route::get('/admin/reservations', [ReservationController::class, 'index'])->name('reservations.index');
    Route::delete('/admin/reservations/{reservation}', [ReservationController::class, 'destroy'])->name('reservations.destroy');

    // 4. Reseñas (Moderación de Admin)
    Route::get('/admin/reviews', [ReviewController::class, 'index'])->name('reviews.index');
    Route::patch('/reviews/{review}/toggle', [ReviewController::class, 'toggleApproval'])->name('reviews.toggle');
    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
    Route::get('/reviews/{review}', [ReviewController::class, 'show'])->name('reviews.show');

    // 5. Bandeja de Mensajes de Contacto (Admin)
    Route::resource('contact_messages', ContactMessageController::class)->only(['index', 'show', 'destroy']);
});

Route::get('/test-produccion-b2', function () {
    try {
        // Intenta guardar un archivo de texto en B2 usando el disco s3
        Storage::disk('s3')->put('prueba-prod.txt', '¡Hola desde producción a Backblaze B2!');

        return "¡Éxito! El archivo se subió correctamente a Backblaze B2 desde producción.";
    } catch (\Exception $e) {
        return "Error al conectar con B2: " . $e->getMessage();
    }
});

Route::get('/test-email', function () {
    $datosPrueba = ['nombre' => 'Tomas'];

    Mail::to('tomas.escudero3010@gmail.com')
        ->send(new ReservationConfirmationMail($datosPrueba));

    return "¡Correo enviado con éxito a través de Resend!";
});

require __DIR__.'/auth.php';
