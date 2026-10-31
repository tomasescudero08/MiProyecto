<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HotelPro - Reservar Habitación</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #121519; color: #e0e0e0; font-family: 'Montserrat', sans-serif; }
        .card-hotel { background-color: #171a1f; border: 1px solid rgba(212, 175, 55, 0.3); border-radius: 10px; }
        .btn-gold { background-color: #d4af37; color: #121212; font-weight: bold; border: none; padding: 0.75rem; }
        .btn-gold:hover { background-color: #c19b2e; }
        h1, h3 { color: #d4af37; font-family: 'Playfair Display', Georgia, serif; }
        .form-control { background-color: #21252b; border-color: #333; color: #fff; }
        .form-control:focus { background-color: #21252b; color: #fff; border-color: #d4af37; box-shadow: 0 0 0 0.25rem rgba(212, 175, 55, 0.25); }
    </style>
</head>
<body class="py-5">
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-hotel p-4 p-md-5">
                <h1 class="mb-3 text-center">Reservar Habitación</h1>
                <p class="text-center text-white opacity-75 mb-4">Completa tus datos personales para solicitar la estancia.</p>

                <div class="row mb-4 p-3 rounded" style="background-color: #121519; border: 1px solid #333;">
                    <div class="col-md-8">
                        <h3 class="fs-4 text-warning mb-1">{{ $room->title }}</h3>
                        <p class="text-gold fw-bold mb-0">${{ number_format($room->price_per_night ?? $room->price, 2) }} USD / noche</p>
                    </div>
                </div>

                <form action="{{ route('reservations.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="room_id" value="{{ $room->id }}">

                    <h5 class="text-warning mb-3">1. Datos Personales</h5>
                    <div class="mb-3">
                        <label class="form-label text-white opacity-75 small">Nombre Completo</label>
                        <input type="text" name="customer_name" class="form-control" placeholder="Ej. Juan Pérez" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-white opacity-75 small">Correo Electrónico</label>
                            <input type="email" name="customer_email" class="form-control" placeholder="juan@gmail.com" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-white opacity-75 small">Teléfono</label>
                            <input type="text" name="customer_phone" class="form-control" placeholder="+57 300 000 0000">
                        </div>
                    </div>

                    <h5 class="text-warning my-3">2. Fechas de Estancia</h5>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-white opacity-75 small">Check-in</label>
                            <input type="date" name="check_in" class="form-control" required min="{{ date('Y-m-d') }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-white opacity-75 small">Check-out</label>
                            <input type="date" name="check_out" class="form-control" required min="{{ date('Y-m-d') }}">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label text-white opacity-75 small">Peticiones Especiales (Opcional)</label>
                        <textarea name="special_requests" class="form-control" rows="2" placeholder="Ej. Llegada tarde, cama extra..."></textarea>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-gold">Confirmar Reserva</button>
                        <a href="{{ route('catalogue') }}" class="btn btn-outline-secondary text-white border-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
