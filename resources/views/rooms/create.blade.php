<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HotelPro - Nueva Habitación</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #121212; color: #e0e0e0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .card-hotel { background-color: #1e1e1e; border: 1px solid #d4af37; border-radius: 10px; box-shadow: 0 10px 30px rgba(0,0,0,0.5); }
        .form-control, .form-select { background-color: #121212; border: 1px solid #333; color: #e0e0e0; }
        .form-control:focus, .form-select:focus { background-color: #121212; border-color: #d4af37; color: #e0e0e0; box-shadow: 0 0 0 0.25rem rgba(212, 175, 55, 0.25); }
        .form-label { color: #d4af37; font-weight: 500; }
        .form-check-input { background-color: #121212; border-color: #444; }
        .form-check-input:checked { background-color: #d4af37; border-color: #d4af37; }
        .form-check-label { color: #e0e0e0; cursor: pointer; }
        .btn-gold { background-color: #d4af37; color: #121212; font-weight: bold; border: none; transition: all 0.2s ease-in-out; }
        .btn-gold:hover { background-color: #c19b2e; color: #121212; transform: translateY(-1px); }
        h1 { color: #d4af37; font-weight: 700; letter-spacing: 0.5px; }
    </style>
</head>
<body class="py-5">
<div class="container" style="max-width: 700px;">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Crear Nueva Habitación</h1>
        <a href="{{ route('rooms.index') }}" class="btn btn-outline-light btn-sm px-3">Volver al listado</a>
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

    <!-- Ruta POST /rooms -->
    <form action="{{ route('rooms.store') }}" method="POST" class="card card-hotel p-4 shadow-lg">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Título de la Habitación</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required placeholder="Ej: Suite Presidencial">
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="category_id" class="form-label">Categoría</label>
                <select class="form-select" id="category_id" name="category_id" required>
                    <option value="" selected disabled>Seleccione una categoría...</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label for="price_per_night" class="form-label">Precio por Noche (USD)</label>
                <input type="number" step="0.01" class="form-control" id="price_per_night" name="price_per_night" value="{{ old('price_per_night') }}" required placeholder="0.00">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="capacity" class="form-label">Capacidad (Personas)</label>
                <input type="number" class="form-control" id="capacity" name="capacity" value="{{ old('capacity', 2) }}" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="badge_tag" class="form-label">Etiqueta destacada (Badge)</label>
                <input type="text" class="form-control" id="badge_tag" name="badge_tag" placeholder="Ej: Más Popular" value="{{ old('badge_tag') }}">
            </div>
        </div>

        <div class="mb-3">
            <label for="image_url" class="form-label">URL de la Imagen</label>
            <input type="text" class="form-control" id="image_url" name="image_url" placeholder="https://..." value="{{ old('image_url') }}">
        </div>

        <div class="mb-3">
            <label for="short_description" class="form-label">Descripción Corta</label>
            <input type="text" class="form-control" id="short_description" name="short_description" value="{{ old('short_description') }}" placeholder="Breve resumen de la habitación">
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Descripción Completa</label>
            <textarea class="form-control" id="description" name="description" rows="4" required placeholder="Detalles completos, comodidades y características...">{{ old('description') }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label d-block">Servicios Incluidos</label>
            <div class="row g-2">
                @foreach($services as $service)
                    <div class="col-md-4 mb-1">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="services[]" value="{{ $service->id }}" id="service_{{ $service->id }}">
                            <label class="form-check-label" for="service_{{ $service->id }}">
                                {{ $service->icon }} {{ $service->name }}
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="mb-4 form-check bg-dark p-3 rounded border border-secondary border-opacity-25">
            <input type="checkbox" class="form-check-input ms-0 me-2" id="is_active" name="is_active" value="1" checked>
            <label class="form-check-label fw-semibold" for="is_active">Habitación Activa (Visible en la web)</label>
        </div>

        <button type="submit" class="btn btn-gold w-100 py-2">Guardar Habitación</button>
    </form>
</div>
</body>
</html>
