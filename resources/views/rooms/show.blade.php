<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HotelPro - Vista Previa: {{ $room->title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #121212; color: #e0e0e0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .card-hotel { background-color: #1e1e1e; border: 1px solid #d4af37; border-radius: 10px; box-shadow: 0 10px 30px rgba(0,0,0,0.5); }
        .text-gold { color: #d4af37 !important; }
        .btn-gold { background-color: #d4af37; color: #121212; font-weight: bold; border: none; transition: all 0.2s ease-in-out; }
        .btn-gold:hover { background-color: #c19b2e; color: #121212; transform: translateY(-1px); }
        .badge-category { background-color: #d4af37; color: #121212; font-weight: 600; padding: 0.5em 0.75em; }
        .badge-service { background-color: #121212 !important; border: 1px solid #333 !important; color: #e0e0e0 !important; font-weight: 500; }
        h1 { font-weight: 700; letter-spacing: 0.5px; }
    </style>
</head>
<body class="py-5">
<div class="container" style="max-width: 800px;">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="text-gold fs-3 mb-0">Detalle de la Habitación</h1>
        <a href="{{ route('catalogue') }}" class="btn btn-outline-light btn-sm px-3">Volver al listado</a>
    </div>

    <div class="card card-hotel shadow-lg overflow-hidden">
        @if($room->image_url)
            <div class="position-relative">
                <img src="{{ $room->image_url }}" alt="{{ $room->title }}" class="w-100" style="max-height: 400px; object-fit: cover;">
                <div class="position-absolute bottom-0 start-0 w-100 h-50" style="background: linear-gradient(to top, rgba(30,30,30,0.9), transparent);"></div>
            </div>
        @endif

        <div class="card-body p-4 p-md-5">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <span class="badge badge-category">{{ $room->category->name ?? 'Sin categoría' }}</span>
                <h3 class="text-gold mb-0">${{ number_format($room->price_per_night, 2) }} USD <small class="text-secondary fs-6">/ noche</small></h3>
            </div>

            <h2 class="mb-3 text-white fw-bold">{{ $room->title }}</h2>
            <p class="text-secondary mb-4">
                <strong>Capacidad:</strong> {{ $room->capacity }} personas
                @isset($room->rating)
                    | <span class="text-warning">★</span> <strong>Valoración:</strong> {{ $room->rating }}
                @endisset
            </p>

            @if($room->badge_tag)
                <div class="mb-4">
                    <span class="badge bg-dark border border-warning text-warning px-3 py-2">{{ $room->badge_tag }}</span>
                </div>
            @endif

            <hr class="border-secondary opacity-25 my-4">

            <h5 class="text-gold mb-3">Descripción</h5>
            <p class="text-secondary lh-lg">{{ $room->description }}</p>

            <h5 class="text-gold mt-4 mb-3">Servicios Incluidos</h5>
            <div class="row g-2">
                @forelse($room->services as $service)
                    <div class="col-md-4 mb-2">
                        <div class="badge badge-service p-3 w-100 text-start d-flex align-items-center gap-2 rounded">
                            <span class="fs-6">{{ $service->icon }}</span>
                            <span class="text-truncate">{{ $service->name }}</span>
                        </div>
                    </div>
                @empty
                    <p class="text-secondary fst-italic">No hay servicios adicionales asignados a esta habitación.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
</body>
</html>
