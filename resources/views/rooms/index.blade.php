<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HotelPro - Gestión y Catálogo de Habitaciones</title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body { background-color: #121519; color: #e0e0e0; font-family: 'Montserrat', sans-serif; }
        .card-hotel { background-color: #171a1f; border: 1px solid rgba(212, 175, 55, 0.3); border-radius: 10px; box-shadow: 0 10px 30px rgba(0,0,0,0.5); }
        .btn-gold { background-color: #d4af37; color: #121212; font-weight: bold; border: none; transition: all 0.2s ease-in-out; }
        .btn-gold:hover { background-color: #c19b2e; color: #121212; transform: translateY(-1px); }

        /* Tabla personalizada oscura y elegante */
        .table-dark-custom { background-color: #171a1f !important; color: #e0e0e0 !important; margin-bottom: 0; }
        .table-dark-custom th { background-color: #0f1114 !important; color: #d4af37 !important; border-bottom: 2px solid #333; font-weight: 600; text-transform: uppercase; font-size: 0.85rem; letter-spacing: 0.5px; padding: 1rem; }
        .table-dark-custom td { background-color: #171a1f !important; color: #e0e0e0 !important; border-color: #2c2c2c !important; padding: 1rem; vertical-align: middle; }
        .table-dark-custom tbody tr { transition: background-color 0.2s ease; }
        .table-dark-custom tbody tr:hover { background-color: #21252b !important; }

        h1 { color: #d4af37; font-weight: 700; letter-spacing: 0.5px; font-family: 'Playfair Display', Georgia, serif; }
        .badge-category { background-color: #2a2a2a; color: #d4af37; border: 1px solid #d4af37; font-weight: 500; padding: 0.5em 0.75em; }
        .btn-outline-gold {
            color: #d4af37;
            border: 1px solid #d4af37;
            background-color: transparent;
            font-weight: 500;
            transition: all 0.2s ease-in-out;
        }
        .btn-outline-gold:hover {
            background-color: #d4af37;
            color: #121212;
            transform: translateY(-1px);
        }
    </style>
</head>
<body>

<!-- NAVBAR PRINCIPAL -->
<header>
    <nav class="navbar navbar-expand-lg navbar-dark navbar-hotel" style="position: relative; background: #121519 !important; border-bottom: 1px solid rgba(255,255,255,0.08);">
        <div class="container-fluid px-lg-5">
            <a class="navbar-brand brand-hotel" href="{{ route('home') }}">Hotel<span>Pro</span></a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link nav-link-hotel" href="{{ route('home') }}">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-hotel {{ request()->routeIs('catalogue') ? 'active' : '' }}" href="{{ route('catalogue') }}">Habitaciones</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-hotel {{ request()->routeIs('services.catalogue') ? 'active' : '' }}" href="{{ route('services.catalogue') }}">Servicios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-hotel" href="{{ route('aboutus') }}">Sobre Nosotros</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-hotel" href="{{ route('contactus') }}">Contáctanos</a>
                    </li>
                    @guest
                        <li class="nav-item"><a class="nav-link text-white" href="{{ route('login') }}">Iniciar Sesión</a></li>
                    @endguest
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-white fw-semibold" href="#" role="button" data-bs-toggle="dropdown">Hola, {{ Auth::user()->name }}</a>
                            <ul class="dropdown-menu dropdown-menu-end bg-dark">
                                <li><a class="dropdown-item text-white" href="{{ route('dashboard') }}">Panel de Control</a></li>
                                <li><hr class="dropdown-divider border-secondary"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">Cerrar Sesión</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endauth
                </ul>
                <div class="d-flex">
                    <a href="{{ route('catalogue') }}" class="btn btn-reservar">Reservar ahora</a>
                </div>
            </div>
        </div>
    </nav>
</header>

<main class="py-5">
    <div class="container py-4">
        <div class="row align-items-center mb-4">
            <div class="col-md-6">
                <h1 class="mb-0">
                    @auth Gestión de Habitaciones @else Nuestro Catálogo de Habitaciones @endauth
                </h1>
            </div>

            <div class="col-md-6 text-md-end mt-3 mt-md-0">
                <div class="d-inline-flex gap-2">
                    <a href="{{ route('home') }}" class="btn btn-outline-gold d-inline-flex align-items-center gap-2">
                        <i class="bi bi-house-door-fill"></i> Volver al Inicio
                    </a>
                    @auth
                        <a href="{{ route('rooms.create') }}" class="btn btn-gold">+ Nueva Habitación</a>
                    @endauth
                </div>
            </div>
        </div>

        @if(session('success'))
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        title: '{{ session("success") }}',
                        showConfirmButton: false,
                        timer: 3500,
                        timerProgressBar: true,
                        background: '#171a1f',
                        color: '#e0e0e0'
                    });
                });
            </script>
        @endif

        <div class="card card-hotel p-4">
            <div class="table-responsive">
                <table class="table table-dark-custom align-middle">
                    <thead>
                    <tr>
                        <th>Imagen</th>
                        <th>Título</th>
                        <th>Categoría</th>
                        <th>Precio / Noche</th>
                        <th>Capacidad</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($rooms as $room)
                        <tr>
                            <td>
                                <img src="{{ $room->image_url ?? 'https://via.placeholder.com/80' }}" alt="" width="60" height="40" style="object-fit: cover; border-radius: 6px; border: 1px solid #333;">
                            </td>
                            <td><strong>{{ $room->title }}</strong></td>
                            <td><span class="badge badge-category">{{ $room->category->name ?? 'Sin categoría' }}</span></td>
                            <td class="text-warning fw-semibold">${{ number_format($room->price_per_night, 2) }} USD</td>
                            <td>{{ $room->capacity }} personas</td>
                            <td class="text-end">
                                <!-- Botón Ver (Detalle) -->
                                <a href="{{ route('rooms.show', $room->id) }}" class="btn btn-sm btn-outline-light px-3">Ver</a>

                                <!-- Botones de administración (Solo si está logueado) -->
                                @auth
                                    <a href="{{ route('rooms.edit', $room->id) }}" class="btn btn-sm btn-warning px-3 fw-semibold">Editar</a>
                                    <form action="{{ route('rooms.destroy', $room->id) }}" method="POST" class="d-inline delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger px-3">Eliminar</button>
                                    </form>
                                @endauth
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-white opacity-75 py-5">
                                <div class="py-3">
                                    <p class="mb-1 fs-5 text-secondary">No hay habitaciones registradas todavía.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            @if(method_exists($rooms, 'links'))
                <div class="mt-4">
                    {{ $rooms->links() }}
                </div>
            @endif
        </div>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteForms = document.querySelectorAll('.delete-form');
        deleteForms.forEach(form => {
            form.addEventListener('submit', function (e) {
                e.preventDefault();
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "¡Esta acción no se puede revertir!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d4af37',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar',
                    background: '#171a1f',
                    color: '#e0e0e0'
                }).then((result) => {
                    if (result.isConfirmed) { form.submit(); }
                });
            });
        });
    });
</script>
</body>
</html>
