<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HotelPro - Detalle de Reserva</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body { background-color: #121519; color: #e0e0e0; font-family: 'Montserrat', sans-serif; }
        .card-hotel { background-color: #171a1f; border: 1px solid rgba(212, 175, 55, 0.3); border-radius: 10px; box-shadow: 0 10px 30px rgba(0,0,0,0.5); }
        .btn-outline-gold { color: #d4af37; border: 1px solid #d4af37; background-color: transparent; }
        .btn-outline-gold:hover { background-color: #d4af37; color: #121212; }
        h1 { color: #d4af37; font-weight: 700; font-family: 'Playfair Display', Georgia, serif; }
        .info-label { color: #d4af37; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px; }
    </style>
</head>
<body class="py-5">
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-hotel p-4 p-md-5">
                <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom border-secondary">
                    <div>
                        <h1 class="mb-0 fs-3">Detalles de la Reserva</h1>
                        <p class="text-white opacity-75 small mb-0">ID de Reserva: #{{ $reservation->id }}</p>
                    </div>
                    <a href="{{ route('reservations.index') }}" class="btn btn-outline-gold btn-sm">
                        <i class="bi bi-arrow-left"></i> Volver al Panel
                    </a>
                </div>

                <div class="row g-4">
                    <div class="col-md-6">
                        <span class="info-label d-block mb-1">Información del Cliente</span>
                        <h5 class="text-white fw-bold mb-1">{{ $reservation->customer_name }}</h5>
                        <p class="text-white opacity-75 mb-1"><i class="bi bi-envelope text-warning"></i> {{ $reservation->customer_email }}</p>
                        <p class="text-white opacity-75 mb-0"><i class="bi bi-telephone text-warning"></i> {{ $reservation->customer_phone ?? 'No proporcionado' }}</p>
                    </div>

                    <div class="col-md-6">
                        <span class="info-label d-block mb-1">Habitación Reservada</span>
                        <h5 class="text-warning fw-bold mb-1">{{ $reservation->room->title ?? 'Habitación no disponible' }}</h5>
                        <p class="text-white opacity-75 mb-0">Precio por noche: ${{ number_format($reservation->room->price_per_night ?? $reservation->room->price ?? 0, 2) }} USD</p>
                    </div>

                    <div class="col-md-6">
                        <span class="info-label d-block mb-1">Fechas de Estancia</span>
                        <p class="text-white mb-1"><i class="bi bi-calendar-check text-success me-1"></i> <b>Check-in:</b> {{ $reservation->check_in }}</p>
                        <p class="text-white mb-0"><i class="bi bi-calendar-x text-danger me-1"></i> <b>Check-out:</b> {{ $reservation->check_out }}</p>
                    </div>

                    <div class="col-md-6">
                        <span class="info-label d-block mb-1">Pago y Estado</span>
                        <h4 class="text-warning fw-bold mb-1">${{ number_format($reservation->total_price, 2) }} USD</h4>
                        <span class="badge bg-dark text-warning border border-warning text-uppercase px-3 py-2">{{ $reservation->status }}</span>
                    </div>

                    @if($reservation->special_requests)
                        <div class="col-12">
                            <span class="info-label d-block mb-1">Peticiones Especiales del Cliente</span>
                            <div class="p-3 rounded" style="background-color: #121519; border: 1px solid #333;">
                                <p class="text-white opacity-75 mb-0">{{ $reservation->special_requests }}</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
