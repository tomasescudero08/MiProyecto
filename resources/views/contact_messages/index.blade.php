<!doctype html>
<html lang="es" data-bs-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HotelPro - Bandeja de Mensajes</title>

    <!-- Bootstrap CSS v5.3.8 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons v1.13.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <!-- Estilos personalizados -->
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body { background-color: #121519; color: #e0e0e0; font-family: 'Montserrat', sans-serif; }
        .table-dark-hotel {
            background-color: #171a1f;
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 8px;
            overflow: hidden;
        }
        .table-dark-hotel th {
            background-color: #0f1114;
            color: #d4af37;
            font-family: 'Playfair Display', Georgia, serif;
            letter-spacing: 1px;
            border-bottom: 1px solid rgba(212, 175, 55, 0.3);
            padding: 1rem;
        }
        .table-dark-hotel td {
            background-color: #171a1f;
            color: #ffffff;
            vertical-align: middle;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            padding: 1rem;
        }
        .modal-content-hotel {
            background-color: #171a1f;
            border: 1px solid rgba(212, 175, 55, 0.4);
            color: #ffffff;
        }
    </style>
</head>
<body>

<!-- NAVBAR FLOTANTE -->
<header>
    <nav class="navbar navbar-expand-lg navbar-dark navbar-hotel" style="position: relative; background: #121519 !important; border-bottom: 1px solid rgba(255,255,255,0.08);">
        <div class="container-fluid px-lg-5">
            <a class="navbar-brand brand-hotel" href="{{ route('home') }}">
                Hotel<span>Pro</span>
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link nav-link-hotel" aria-current="page" href="{{ route('home') }}">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-hotel {{ request()->routeIs('catalogue') ? 'active' : '' }}" href="{{ route('catalogue') }}">Habitaciones</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-hotel {{ request()->routeIs('services.catalogue') ? 'active' : '' }}" href="{{ route('services.catalogue') }}">Servicios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-hotel active" href="{{ route('aboutus') }}">Sobre Nosotros</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-hotel" href="{{ route('contactus') }}">Contáctanos</a>
                    </li>
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-white fw-semibold" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                                Hola, {{ Auth::user()->name }}
                            </a>
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

<main class="py-5" style="background-color: #121519; min-height: 80vh;">
    <div class="container py-4">

        <!-- Cabecera de la Sección -->
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
            <div>
                <span class="feature-badge mb-2">
                    <span class="badge-dot"></span> Mensajería Pública
                </span>
                <h1 class="section-title mb-0">Bandeja de Contacto</h1>
            </div>
            <a href="{{ route('dashboard') }}" class="btn btn-gold-outline btn-sm">
                <i class="bi bi-arrow-left me-1"></i> Volver al Panel
            </a>
        </div>

        <!-- Alerta de éxito -->
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
                        background: '#1e1e1e',
                        color: '#e0e0e0'
                    });
                });
            </script>
        @endif

        <!-- Tabla de Mensajes -->
        <div class="table-responsive table-dark-hotel shadow-lg">
            <table class="table table-dark align-middle mb-0">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Remitente</th>
                    <th scope="col">Contacto</th>
                    <th scope="col">Asunto</th>
                    <th scope="col">Fecha</th>
                    <th scope="col" class="text-end">Acciones</th>
                </tr>
                </thead>
                <tbody>
                @forelse($messages as $msg)
                    <tr>
                        <td class="text-white opacity-75 fw-semibold">{{ $msg->id }}</td>
                        <td>
                            <div class="fw-bold text-white">{{ $msg->name }}</div>
                        </td>
                        <td>
                            <div class="text-white opacity-75 small"><i class="bi bi-envelope me-1 text-warning"></i> {{ $msg->email }}</div>
                            @if($msg->phone)
                                <div class="text-white opacity-75 small"><i class="bi bi-telephone me-1 text-warning"></i> {{ $msg->phone }}</div>
                            @endif
                        </td>
                        <td>
                            <span class="badge bg-dark border border-secondary text-white">{{ $msg->subject ?? 'Consulta General' }}</span>
                        </td>
                        <td class="text-white opacity-75 small">
                            {{ $msg->created_at->format('d/m/Y h:i A') }}
                        </td>
                        <td class="text-end">
                            <div class="d-inline-flex gap-2">
                                <!-- Botón para Abrir Modal con el Contenido -->
                                <button type="button" class="btn btn-gold-outline btn-sm" data-bs-toggle="modal" data-bs-target="#messageModal{{ $msg->id }}">
                                    <i class="bi bi-eye-fill"></i> Leer
                                </button>

                                <!-- Formulario para Eliminar -->
                                <form action="{{ route('contact_messages.destroy', $msg->id) }}" method="POST" class="d-inline form-delete-msg">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger px-3">Eliminar</button>
                                </form>
                            </div>
                        </td>
                    </tr>

                    <!-- Modal de Detalle del Mensaje -->
                    <div class="modal fade" id="messageModal{{ $msg->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $msg->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content modal-content-hotel">
                                <div class="modal-header border-bottom border-secondary">
                                    <h5 class="modal-title text-gold" id="modalLabel{{ $msg->id }}">
                                        <i class="bi bi-chat-left-text me-2"></i> Mensaje de {{ $msg->name }}
                                    </h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <p class="text-white opacity-75 mb-1"><strong>Correo:</strong> {{ $msg->email }}</p>
                                        <p class="text-white opacity-75 mb-1"><strong>Teléfono:</strong> {{ $msg->phone ?? 'No proporcionado' }}</p>
                                        <p class="text-white opacity-75 mb-1"><strong>Asunto:</strong> {{ $msg->subject ?? 'Sin asunto' }}</p>
                                        <p class="text-white opacity-75 mb-0"><small><strong>Enviado el:</strong> {{ $msg->created_at->format('d/m/Y - h:i A') }}</small></p>
                                    </div>
                                    <hr class="border-secondary opacity-25">
                                    <div class="p-3 bg-dark rounded border border-secondary border-opacity-25">
                                        <h6 class="text-gold mb-2">Mensaje:</h6>
                                        <!-- Añadimos 'text-break' para que el texto largo baje automáticamente -->
                                        <p class="text-white opacity-75 mb-0 text-break" style="white-space: pre-line;">{{ $msg->message }}</p>
                                    </div>
                                </div>
                                <div class="modal-footer border-top border-secondary">
                                    <a href="mailto:{{ $msg->email }}" class="btn btn-gold-solid btn-sm">
                                        <i class="bi bi-reply-fill me-1"></i> Responder por Correo
                                    </a>
                                    <button type="button" class="btn btn-outline-light btn-sm" data-bs-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>

                @empty
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <i class="bi bi-inbox display-4 text-warning d-block mb-3"></i>
                            <h5 class="text-white">No hay mensajes en la bandeja</h5>
                            <p class="text-white opacity-75 small">Los mensajes recibidos desde el formulario de contacto aparecerán aquí.</p>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

    </div>
</main>

<!-- FOOTER -->
<footer class="hotel-footer pt-5 pb-4">
    <div class="container py-4">
        <div class="row g-4 justify-content-between">
            <div class="col-lg-3 col-md-6">
                <a class="navbar-brand brand-hotel d-block mb-3" href="{{ route('home') }}">
                    Hotel<span>Pro</span>
                </a>
                <p class="footer-description text-white opacity-75">
                    Tu refugio de lujo definitivo para descubrir la máxima comodidad, elegancia y experiencias inolvidables.
                </p>
            </div>
            <div class="col-lg-2 col-md-6 ms-lg-auto">
                <h5 class="footer-heading mb-3">Navegación</h5>
                <ul class="list-unstyled footer-links">
                    <li><a href="{{ route('home') }}" class="text-white opacity-75">Inicio</a></li>
                    <li><a href="{{ route('rooms.index') }}" class="text-white opacity-75">Habitaciones</a></li>
                    <li><a href="{{ route('services.index') }}" class="text-white opacity-75">Servicios</a></li>
                    <li><a href="{{ route('aboutus') }}" class="text-white opacity-75">Sobre Nosotros</a></li>
                    <li><a href="{{ route('contactus') }}" class="text-white opacity-75">Contáctanos</a></li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-6">
                <h5 class="footer-heading mb-3">Contacto</h5>
                <ul class="list-unstyled footer-contact text-white opacity-75">
                    <li class="d-flex align-items-center gap-2 mb-2">
                        <span class="contact-icon">✉</span>
                        <span>reservas@hotelpro.com</span>
                    </li>
                    <li class="d-flex align-items-center gap-2 mb-2">
                        <span class="contact-icon">📞</span>
                        <span>+57 322 687 80 17</span>
                    </li>
                    <li class="d-flex align-items-center gap-2">
                        <span class="contact-icon">📍</span>
                        <span>Medellín, Colombia</span>
                    </li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-6">
                <h5 class="footer-heading mb-3">Síguenos</h5>
                <div class="d-flex gap-2">
                    <a href="#" class="social-icon-btn" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="social-icon-btn" aria-label="Twitter / X"><i class="bi bi-twitter-x"></i></a>
                    <a href="#" class="social-icon-btn" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="social-icon-btn" aria-label="YouTube"><i class="bi bi-youtube"></i></a>
                </div>
            </div>
        </div>
        <div class="border-top border-dark-subtle mt-5 pt-4 text-center">
            <p class="footer-copyright mb-0 text-white opacity-50">
                &copy; {{ date('Y') }} HotelPro. Todos los derechos reservados.
            </p>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Seleccionamos todos los formularios de eliminación
        const deleteForms = document.querySelectorAll('.form-delete-msg');

        deleteForms.forEach(form => {
            form.addEventListener('submit', function (event) {
                event.preventDefault(); // Detenemos el envío inmediato del formulario

                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "¡Esta acción no se puede revertir!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d4af37', // Color dorado de HotelPro
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar',
                    background: '#1e1e1e', // Fondo oscuro acorde a tu diseño
                    color: '#e0e0e0' // Color de texto claro
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Forzamos el envío nativo del formulario evadiendo el listener de JS
                        HTMLFormElement.prototype.submit.call(form);
                    }
                });
            });
        });
    });
</script>
</body>
</html>
