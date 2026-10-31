<!doctype html>
<html lang="es" data-bs-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HotelPro - Listado de Reservas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <style>
        body { background-color: #121519; color: #e0e0e0; font-family: 'Montserrat', sans-serif; }
        .table-dark-hotel { background-color: #171a1f; border: 1px solid rgba(255, 255, 255, 0.08); border-radius: 8px; }
        .table-dark-hotel th { background-color: #0f1114; color: #d4af37; border-bottom: 1px solid rgba(212, 175, 55, 0.3); padding: 1rem; }
        .table-dark-hotel td { background-color: #171a1f; color: #ffffff; padding: 1rem; }
    </style>
</head>
<body>

<main class="py-5" style="background-color: #121519; min-height: 80vh;">
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
            <div>
                <span class="feature-badge mb-2"><span class="badge-dot"></span> Gestión Central</span>
                <h1 class="section-title mb-0">Reservas de Habitaciones</h1>
            </div>
            <a href="{{ route('dashboard') }}" class="btn btn-gold-outline btn-sm"><i class="bi bi-arrow-left me-1"></i> Volver al Panel</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success bg-dark text-white border-success mb-4" role="alert">
                <i class="bi bi-check-circle-fill text-success me-2"></i> {{ session('success') }}
            </div>
        @endif

        <div class="table-responsive table-dark-hotel shadow-lg">
            <table class="table table-dark align-middle mb-0">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Cliente</th>
                    <th>Habitación</th>
                    <th>Check-In</th>
                    <th>Check-Out</th>
                    <th>Total</th>
                    <th>Estado</th>
                    <th class="text-end">Acciones</th>
                </tr>
                </thead>
                <tbody>
                @forelse($reservations as $res)
                    <tr>
                        <td class="fw-bold text-white">{{ $res->id }}</td>
                        <td>{{ $res->user->name ?? 'Usuario' }}</td>
                        <td>{{ $res->room->title ?? 'Habitación N/A' }}</td>
                        <td>{{ $res->check_in }}</td>
                        <td>{{ $res->check_out }}</td>
                        <td class="text-gold fw-bold">${{ number_format($res->total_price, 0) }}</td>
                        <td><span class="badge bg-warning text-dark">{{ ucfirst($res->status) }}</span></td>
                        <td class="text-end">
                            <form action="{{ route('reservations.destroy', $res->id) }}" method="POST" onsubmit="return confirm('¿Cancelar esta reserva?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm"><i class="bi bi-trash-fill"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center py-5 text-white opacity-75">No hay reservas registradas.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
