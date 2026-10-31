<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HotelPro - Editar Servicio: {{ $service->name }}</title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #121212; color: #e0e0e0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .card-hotel { background-color: #1e1e1e; border: 1px solid #d4af37; border-radius: 10px; box-shadow: 0 10px 30px rgba(0,0,0,0.5); }
        .form-control, .form-select { background-color: #121212; border: 1px solid #333; color: #e0e0e0; }
        .form-control:focus, .form-select:focus { background-color: #121212; border-color: #d4af37; color: #e0e0e0; box-shadow: 0 0 0 0.25rem rgba(212, 175, 55, 0.25); }
        .form-label { color: #d4af37; font-weight: 500; }
        .btn-gold { background-color: #d4af37; color: #121212; font-weight: bold; border: none; transition: all 0.2s ease-in-out; }
        .btn-gold:hover { background-color: #c19b2e; color: #121212; transform: translateY(-1px); }
        h1 { color: #d4af37; font-weight: 700; letter-spacing: 0.5px; }
    </style>
</head>
<body class="py-5">
<div class="container" style="max-width: 700px;">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fs-3 mb-0">Editar Servicio</h1>
        <!-- Ruta GET /services -->
        <a href="{{ route('services.index') }}" class="btn btn-outline-light btn-sm px-3">Volver al listado</a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger bg-dark text-danger border-danger shadow-sm">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Ruta PUT /services/{service} -->
    <form action="{{ route('services.update', $service->id) }}" method="POST" class="card card-hotel p-4 shadow-lg">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Nombre del Servicio</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $service->name) }}" required>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="icon" class="form-label">Icono (Emoji / Texto)</label>
                <input type="text" class="form-control" id="icon" name="icon" value="{{ old('icon', $service->icon) }}" placeholder="Ej. 🍷, 🏊‍♂️, ✦">
            </div>
            <div class="col-md-6 mb-3">
                <label for="price" class="form-label">Precio (USD)</label>
                <input type="number" step="0.01" class="form-control" id="price" name="price" value="{{ old('price', $service->price) }}" placeholder="Ej. 25.00">
            </div>
        </div>

        <div class="mb-4">
            <label for="description" class="form-label">Descripción del Servicio</label>
            <textarea class="form-control" id="description" name="description" rows="4" required>{{ old('description', $service->description) }}</textarea>
        </div>

        <button type="submit" class="btn btn-gold w-100 py-2">Actualizar Servicio</button>
    </form>
</div>
</body>
</html>
