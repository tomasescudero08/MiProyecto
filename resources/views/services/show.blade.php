<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HotelPro - Vista Previa: {{ $service->name }}</title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome para iconos opcionales -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background-color: #121212; color: #e0e0e0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .card-hotel { background-color: #1e1e1e; border: 1px solid #d4af37; border-radius: 10px; box-shadow: 0 10px 30px rgba(0,0,0,0.5); }
        .text-gold { color: #d4af37 !important; }
        .btn-gold { background-color: #d4af37; color: #121212; font-weight: bold; border: none; transition: all 0.2s ease-in-out; }
        .btn-gold:hover { background-color: #c19b2e; color: #121212; transform: translateY(-1px); }
        h1 { font-weight: 700; letter-spacing: 0.5px; }
    </style>
</head>
<body class="py-5">
<div class="container" style="max-width: 800px;">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="text-gold fs-3 mb-0">Detalle del Servicio</h1>
        <a href="{{ route('services.catalogue') }}" class="btn btn-outline-light btn-sm px-3">Volver al listado</a>
    </div>

    <div class="card card-hotel shadow-lg overflow-hidden">
        <div class="card-body p-4 p-md-5">
            <div class="d-flex align-items-center mb-4">
                <div class="display-4 me-4 text-warning p-3 bg-dark rounded border border-secondary border-opacity-25" style="min-width: 80px; text-align: center;">
                    {{ $service->icon ?? '✦' }}
                </div>
                <div>
                    <h2 class="text-white fw-bold mb-2">{{ $service->name }}</h2>
                    <span class="badge bg-dark border border-warning text-warning px-3 py-2">Servicio Activo HotelPro</span>
                </div>
            </div>

            <hr class="border-secondary opacity-25 my-4">

            <h5 class="text-gold mb-3">Descripción</h5>
            <p class="text-secondary lh-lg" style="white-space: pre-line;">{{ $service->description }}</p>

            {{--
              - @auth asegura que el botón de edición solo se muestre
              - si el usuario ha iniciado sesión en el panel de control.
            --}}
            @auth
                <div class="d-flex justify-content-end gap-2 mt-5 pt-3 border-top border-secondary border-opacity-25">
                    <a href="{{ route('services.edit', $service->id) }}" class="btn btn-gold px-4 fw-semibold">Editar Servicio</a>
                </div>
            @endauth

        </div>
    </div>
</div>
</body>
</html>
