<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HotelPro - Comprobante de Reserva</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body { background-color: #121519; color: #e0e0e0; font-family: 'Montserrat', sans-serif; }
        .card-hotel { background-color: #171a1f; border: 1px solid rgba(212, 175, 55, 0.3); border-radius: 10px; box-shadow: 0 10px 30px rgba(0,0,0,0.5); }
        .btn-gold { background-color: #d4af37; color: #121212; font-weight: bold; border: none; transition: all 0.2s; }
        .btn-gold:hover { background-color: #c19b2e; color: #121212; }
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

            @if(session('success'))
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        Swal.fire({
                            toast: true, position: 'top-end', icon: 'success',
                            title: '{{ session("success") }}', showConfirmButton: false, timer: 4000,
                            background: '#171a1f', color: '#e0e0e0'
                        });
                    });
                </script>
            @endif

            <div class="card card-hotel p-4 p-md-5 text-center text-md-start">
                <div class="text-center mb-4">
                    <i class="bi bi-check-circle-fill text-warning display-3"></i>
                    <h1 class="mt-2">¡Reserva Solicitada con Éxito!</h1>
                    <p class="text-white opacity-75">Hemos registrado tu solicitud correctamente. Aquí tienes los detalles de tu estancia:</p>
                </div>

                <div class="row g-4 p-3 rounded mb-4" style="background-color: #121519; border: 1px solid #333;">
                    <div class="col-md-6">
                        <span class="info-label d-block mb-1">Código de Reserva</span>
                        <h4 class="text-white fw-bold">#{{ $reservation->id }}</h4>
                    </div>
                    <div class="col-md-6">
                        <span class="info-label d-block mb-1">Estado Actual</span>
                        <span class="badge bg-dark text-warning border border-warning text-uppercase px-3 py-2">{{ $reservation->status }}</span>
                    </div>

                    <div class="col-md-6">
                        <span class="info-label d-block mb-1">Titular de la Reserva</span>
                        <h5 class="text-white mb-1">{{ $reservation->customer_name }}</h5>
                        <p class="text-white opacity-75 small mb-0">{{ $reservation->customer_email }} | {{ $reservation->customer_phone ?? 'Sin teléfono' }}</p>
                    </div>

                    <div class="col-md-6">
                        <span class="info-label d-block mb-1">Habitación</span>
                        <h5 class="text-warning mb-0">{{ $reservation->room->title ?? 'Habitación' }}</h5>
                    </div>

                    <div class="col-md-6">
                        <span class="info-label d-block mb-1">Fechas</span>
                        <p class="text-white mb-1"><i class="bi bi-calendar-check text-success"></i> <b>Check-in:</b> {{ $reservation->check_in }}</p>
                        <p class="text-white mb-0"><i class="bi bi-calendar-x text-danger"></i> <b>Check-out:</b> {{ $reservation->check_out }}</p>
                    </div>

                    <div class="col-md-6">
                        <span class="info-label d-block mb-1">Total Estimado</span>
                        <h4 class="text-warning fw-bold mb-0">${{ number_format($reservation->total_price, 2) }} USD</h4>
                    </div>

                    @if($reservation->special_requests)
                        <div class="col-12">
                            <span class="info-label d-block mb-1">Peticiones Especiales</span>
                            <p class="text-white opacity-75 mb-0">{{ $reservation->special_requests }}</p>
                        </div>
                    @endif
                </div>

                <div class="d-flex justify-content-center gap-3">
                    <a href="{{ route('catalogue') }}" class="btn btn-outline-gold px-4">Volver al Catálogo</a>
                    <a href="{{ route('home') }}" class="btn btn-gold px-4">Ir al Inicio</a>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
