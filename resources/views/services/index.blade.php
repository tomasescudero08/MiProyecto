<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HotelPro - Gestión y Catálogo de Servicios</title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <!-- Estilos personalizados principales -->
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

        h1, h3 { color: #d4af37; font-weight: 700; letter-spacing: 0.5px; font-family: 'Playfair Display', Georgia, serif; }
        .text-gold { color: #d4af37 !important; }

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
        .modal-content-hotel {
            background-color: #171a1f;
            border: 1px solid #d4af37;
            color: #e0e0e0;
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
                    <li class="nav-item"><a class="nav-link nav-link-hotel" href="{{ route('home') }}">Inicio</a></li>
                    <li class="nav-item">
                        @auth
                            <!-- Logueado: Envía al CRUD / Administración de habitaciones -->
                            <a class="nav-link nav-link-hotel {{ request()->routeIs('rooms.*') ? 'active' : '' }}" href="{{ route('rooms.index') }}">
                                Habitaciones (Admin)
                            </a>
                        @else
                            <!-- Invitado: Envía al Catálogo Público -->
                            <a class="nav-link nav-link-hotel {{ request()->routeIs('catalogue') ? 'active' : '' }}" href="{{ route('catalogue') }}">
                                Habitaciones
                            </a>
                        @endauth
                    </li>

                    <!-- ENLACE DE SERVICIOS -->
                    <li class="nav-item">
                        @auth
                            <!-- Logueado: Envía al CRUD / Administración de servicios -->
                            <a class="nav-link nav-link-hotel {{ request()->routeIs('services.*') ? 'active' : '' }}" href="{{ route('services.index') }}">
                                Servicios (Admin)
                            </a>
                        @else
                            <!-- Invitado: Envía al Catálogo Público de Servicios -->
                            <a class="nav-link nav-link-hotel {{ request()->routeIs('services.index') ? 'active' : '' }}" href="{{ route('services.index') }}">                                Servicios
                            </a>
                        @endauth
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-hotel" href="{{ route('aboutus') }}">Sobre Nosotros</a>
                    </li>
                    @auth
                        <li class="nav-item">
                            <a class="nav-link nav-link-hotel" href="{{ route('contact_messages.index') }}">Bandeja de Contacto</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link nav-link-hotel" href="{{ route('contactus') }}">Contáctanos</a>
                        </li>
                    @endauth
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
                    @auth
                        <a href="{{ route('reservations.index') }}" class="btn btn-reservar">
                            <i class="bi bi-shield-lock-fill"></i> Gestionar Reservas
                        </a>
                    @else
                        <a href="{{ route('catalogue') }}" class="btn btn-reservar">
                            Reservar Ahora
                        </a>
                    @endauth
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
                    @auth Gestión de Servicios @else Nuestros Servicios Exclusivos @endauth
                </h1>
                @guest
                    <p class="text-white opacity-75 mt-1 mb-0">Disfruta de instalaciones y amenidades de clase mundial.</p>
                @endguest
            </div>

            <div class="col-md-6 text-md-end mt-3 mt-md-0">
                <div class="d-inline-flex gap-2">
                    <a href="{{ route('home') }}" class="btn btn-outline-gold d-inline-flex align-items-center gap-2">
                        <i class="bi bi-house-door-fill"></i> Volver al Inicio
                    </a>
                    <!-- Botón de crear visible solo si está logueado -->
                    @auth
                        <a href="{{ route('services.create') }}" class="btn btn-gold">+ Nuevo Servicio</a>
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
                        <th style="width: 50px;">#</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Descripción</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($services as $index => $service)
                        <tr>
                            <td><strong>{{ $loop->iteration }}</strong></td>
                            <td><strong>{{ $service->name }}</strong></td>
                            <td class="text-warning fw-semibold">${{ number_format($service->price ?? 0, 2) }} USD</td>
                            <td class="text-white opacity-75">{{ Str::limit($service->description, 40, '...') }}</td>
                            <td class="text-end">
                                <!-- Botón Ver (Modal) disponible para todos -->
                                <button type="button" class="btn btn-sm btn-outline-light px-3" data-bs-toggle="modal" data-bs-target="#serviceModal{{ $service->id }}">
                                    Ver
                                </button>

                                <!-- Acciones de edición y eliminación restringidas al Admin / Auth -->
                                @auth
                                    <a href="{{ route('services.edit', $service->id) }}" class="btn btn-sm btn-warning px-3 fw-semibold">Editar</a>
                                    <form action="{{ route('services.destroy', $service->id) }}" method="POST" class="d-inline delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger px-3">Eliminar</button>
                                    </form>
                                @endauth
                            </td>
                        </tr>

                        <!-- MODAL DE DETALLE -->
                        <div class="modal fade" id="serviceModal{{ $service->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content modal-content-hotel shadow-lg">
                                    <div class="modal-header border-secondary">
                                        <h5 class="modal-title text-warning">Detalle del Servicio</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body p-4">
                                        <h3 class="text-gold mb-2">{{ $service->name }}</h3>
                                        <p class="fs-5 text-warning mb-3"><strong>Precio:</strong> ${{ number_format($service->price ?? 0, 2) }} USD</p>
                                        <hr class="border-secondary">
                                        <h6 class="text-gold">Descripción Completa:</h6>
                                        <p class="text-light" style="white-space: pre-line;">{{ $service->description }}</p>
                                    </div>
                                    <div class="modal-footer border-secondary">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                        @auth
                                            <a href="{{ route('services.edit', $service->id) }}" class="btn btn-gold">Editar Servicio</a>
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-white opacity-75 py-5">
                                <div class="py-3">
                                    <p class="mb-1 fs-5 text-secondary">No hay servicios registrados todavía.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            @if(method_exists($services, 'links'))
                <div class="mt-4">
                    {{ $services->links() }}
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
