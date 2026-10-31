<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HotelPro - Editar Reserva</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #121519; color: #e0e0e0; font-family: 'Montserrat', sans-serif; }
        .card-hotel { background-color: #171a1f; border: 1px solid rgba(212, 175, 55, 0.3); border-radius: 10px; }
        .btn-outline-gold { color: #d4af37; border: 1px solid #d4af37; }
        .btn-outline-gold:hover { background-color: #d4af37; color: #121212; }
        h1 { color: #d4af37; font-family: 'Playfair Display', Georgia, serif; }
    </style>
</head>
<>
    <body class="py-5">
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card card-hotel p-4 text-center">
                    <h1 class="mb-3">Editar Reserva #{{ $reservation->id }}</h1>
                    <p class="text-white opacity-75 mb-4">Esta sección se encuentra en mantenimiento o gestiona los
                        estados de la estancia directamente.</p>
                    <div>
</>
                    <a href="{{ route('reservations.index') }}" class="btn btn-outline-gold">Regresar al Panel Admin</a>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
