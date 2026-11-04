<!doctype html>
<html lang="es" data-bs-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HotelPro - Panel de Control</title>
    <!-- Bootstrap CSS v5.3.8 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons v1.13.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <!-- Estilos personalizados -->
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <style>
        body { background-color: #121519; color: #e0e0e0; font-family: 'Montserrat', sans-serif; }
        .text-gold { color: #d4af37 !important; }
    </style>
</head>
<body>

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
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle active text-gold fw-semibold" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                                Hola, {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end bg-dark border-secondary">
                                <li><a class="dropdown-item text-white active" href="{{ route('dashboard') }}">Panel de Control</a></li>
                                <li><a class="dropdown-item text-warning" href="{{ route('reservations.index') }}">Ver Todas las Reservas</a></li>
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
                    <a href="{{ route('reservations.index') }}" class="btn btn-reservar">
                        <i class="bi bi-shield-lock-fill me-1"></i> Gestionar Reservas
                    </a>
                </div>
            </div>
        </div>
    </nav>
</header>

<main class="py-5" style="background-color: #121519; min-height: 80vh;">
    <div class="container py-4">
        <div class="row mb-4 align-items-center">
            <div class="col">
                <span class="feature-badge mb-2">
                    <span class="badge-dot"></span> Panel Administrativo
                </span>
                <h1 class="section-title">Bienvenido, {{ Auth::user()->name }}</h1>
                <p class="section-subtitle text-white opacity-75">Desde aquí puedes administrar todas las secciones clave de HotelPro.</p>
            </div>
        </div>

        <div class="row g-4">
            <!-- 1. GESTIÓN DE HABITACIONES -->
            <div class="col-md-6 col-lg-4">
                <div class="service-card p-4 h-100 d-flex flex-column justify-content-between" style="background-color: #171a1f; border: 1px solid rgba(255,255,255,0.08);">
                    <div>
                        <div class="service-icon mb-3 text-gold fs-2"><i class="bi bi-door-open"></i></div>
                        <h5 class="service-title text-white fw-bold">Gestión de Habitaciones</h5>
                        <p class="service-desc mt-2 text-white opacity-75">Agrega, edita o elimina las habitaciones y suites disponibles en el catálogo público.</p>
                    </div>
                    <div class="mt-4 pt-3 border-top border-secondary border-opacity-25">
                        <a href="{{ route('rooms.index') }}" class="btn btn-gold-solid w-100 btn-sm fw-semibold">Administrar Habitaciones</a>
                    </div>
                </div>
            </div>

            <!-- 2. GESTIÓN DE SERVICIOS -->
            <div class="col-md-6 col-lg-4">
                <div class="service-card p-4 h-100 d-flex flex-column justify-content-between" style="background-color: #171a1f; border: 1px solid rgba(255,255,255,0.08);">
                    <div>
                        <div class="service-icon mb-3 text-gold fs-2"><i class="bi bi-bell"></i></div>
                        <h5 class="service-title text-white fw-bold">Gestión de Servicios</h5>
                        <p class="service-desc mt-2 text-white opacity-75">Configura los servicios, amenidades y experiencias exclusivas para los huéspedes.</p>
                    </div>
                    <div class="mt-4 pt-3 border-top border-secondary border-opacity-25">
                        <a href="{{ route('services.index') }}" class="btn btn-gold-solid w-100 btn-sm fw-semibold">Administrar Servicios</a>
                    </div>
                </div>
            </div>

            <!-- 3. GESTIÓN DE RESERVAS -->
            <div class="col-md-6 col-lg-4">
                <div class="service-card p-4 h-100 d-flex flex-column justify-content-between" style="background-color: #171a1f; border: 1px solid rgba(255,255,255,0.08);">
                    <div>
                        <div class="service-icon mb-3 text-gold fs-2"><i class="bi bi-calendar-check"></i></div>
                        <h5 class="service-title text-white fw-bold">Gestión de Reservas</h5>
                        <p class="service-desc mt-2 text-white opacity-75">Consulta la lista completa de reservaciones, fechas de estancia y estado de huéspedes.</p>
                    </div>
                    <div class="mt-4 pt-3 border-top border-secondary border-opacity-25">
                        <a href="{{ route('reservations.index') }}" class="btn btn-gold-solid w-100 btn-sm fw-semibold">Ver Reservaciones</a>
                    </div>
                </div>
            </div>

            <!-- 4. MODERACIÓN DE RESEÑAS -->
            <div class="col-md-6 col-lg-4">
                <div class="service-card p-4 h-100 d-flex flex-column justify-content-between" style="background-color: #171a1f; border: 1px solid rgba(255,255,255,0.08);">
                    <div>
                        <div class="service-icon mb-3 text-gold fs-2"><i class="bi bi-star-half"></i></div>
                        <h5 class="service-title text-white fw-bold">Moderación de Reseñas</h5>
                        <p class="service-desc mt-2 text-white opacity-75">Revisa las opiniones y calificaciones enviadas por los visitantes, pruébalas u ocúltalas.</p>
                    </div>
                    <div class="mt-4 pt-3 border-top border-secondary border-opacity-25">
                        <a href="{{ route('reviews.index') }}" class="btn btn-gold-solid w-100 btn-sm fw-semibold">Gestionar Reseñas</a>
                    </div>
                </div>
            </div>

            <!-- 5. BANDEJA DE MENSAJES DE CONTACTO -->
            <div class="col-md-6 col-lg-4">
                <div class="service-card p-4 h-100 d-flex flex-column justify-content-between" style="background-color: #171a1f; border: 1px solid rgba(255,255,255,0.08);">
                    <div>
                        <div class="service-icon mb-3 text-gold fs-2"><i class="bi bi-inbox"></i></div>
                        <h5 class="service-title text-white fw-bold">Bandeja de Contacto</h5>
                        <p class="service-desc mt-2 text-white opacity-75">Lee y responde las consultas enviadas por clientes a través del formulario de contacto.</p>
                    </div>
                    <div class="mt-4 pt-3 border-top border-secondary border-opacity-25">
                        <a href="{{ route('contact_messages.index') }}" class="btn btn-gold-solid w-100 btn-sm fw-semibold">Ver Mensajes</a>
                    </div>
                </div>
            </div>

            <!-- 6. ESTADO DEL SISTEMA -->
            <div class="col-md-6 col-lg-4">
                <div class="service-card p-4 h-100 d-flex flex-column justify-content-between" style="background-color: #171a1f; border: 1px solid rgba(255,255,255,0.08);">
                    <div>
                        <div class="service-icon mb-3 text-gold fs-2"><i class="bi bi-shield-check"></i></div>
                        <h5 class="service-title text-white fw-bold">Estado del Sistema</h5>
                        <p class="service-desc mt-2 text-white opacity-75">Sesión iniciada de forma segura con el rol verificado de administrador en HotelPro.</p>
                    </div>
                    <div class="mt-4 pt-3 border-top border-secondary border-opacity-25 text-white small opacity-75 d-flex justify-content-between align-items-center">
                        <span class="text-gold"><i class="bi bi-check-circle-fill me-1"></i> Sistema activo</span>
                        <span class="badge bg-dark border border-secondary text-warning">v1.0 Pro</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</main>

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
</body>
</html>
