<!doctype html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HotelPro - Catálogo de Habitaciones</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
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
                            <a class="nav-link nav-link-hotel {{ request()->routeIs('services.catalogue') ? 'active' : '' }}" href="{{ route('services.catalogue') }}">
                                Servicios
                            </a>
                        @endauth
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-hotel" href="{{ route('aboutus') }}">Sobre Nosotros</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-hotel" href="{{ route('contactus') }}">Contáctanos</a>
                    </li>
                    @guest
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('login') }}">Iniciar Sesión</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn btn-gold text-dark ms-2" href="{{ route('register') }}" style="background-color: #d4af37;">Registrarse</a>
                        </li>
                    @endguest

                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-white" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
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
        <div class="text-center mb-5">
            <span class="feature-badge mb-2">
                <span class="badge-dot"></span> Catálogo Exclusivo
            </span>
            <h1 class="section-title">Nuestras Habitaciones</h1>
            <p class="section-subtitle mx-auto text-white opacity-75">Explora nuestra selección de habitaciones y suites diseñadas para brindarte el máximo confort y descanso.</p>
        </div>

        @if(isset($rooms) && $rooms->count() > 0)
            <div class="row g-4">
                @foreach($rooms as $room)
                    <div class="col-sm-6 col-lg-4">
                        <div class="room-card h-100">
                            <div class="room-img-container position-relative">
                                <img src="{{ $room->image_url ?? ($room->image ? asset('storage/' . $room->image) : 'https://images.unsplash.com/photo-1590490360182-c33d57733427?q=80&w=600&auto=format&fit=crop') }}" alt="{{ $room->title }}" class="room-img">
                                <span class="badge-tag gold-badge">{{ $room->badge_tag ?? ($room->category->name ?? 'Suite') }}</span>
                            </div>
                            <div class="room-card-body p-3 d-flex flex-column justify-content-between">
                                <div>
                                    <div class="room-stars mb-1">
                                        ★★★★★ <span class="rating-text text-white opacity-75">({{ $room->rating ?? '5.0' }})</span>
                                    </div>
                                    <h5 class="room-name mb-1">{{ $room->title }}</h5>
                                    <p class="room-category mb-2 text-white opacity-75">Capacidad: {{ $room->capacity ?? '2' }} Personas</p>
                                    <p class="room-short-desc text-white opacity-75">{{ Str::limit($room->description, 90) }}</p>
                                </div>
                                <div class="d-flex align-items-center justify-content-between mt-3 pt-2 border-top border-dark-subtle">
                                    <div class="room-price">${{ number_format($room->price_per_night ?? $room->price, 0) }} <small class="text-white opacity-75">/ noche</small></div>
                                    <a href="{{ route('reservations.create', $room->id) }}" class="btn btn-sm btn-gold text-gold">
                                        Reservar
                                    </a>
                                    <a href="{{ route('rooms.show', $room->id) }}" class="btn btn-room-buy">Ver Detalles</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-5">
                <div class="card bg-dark border-secondary p-5 mx-auto" style="max-width: 500px;">
                    <i class="bi bi-door-closed display-4 text-warning mb-3"></i>
                    <h3 class="text-white">No hay habitaciones disponibles</h3>
                    <p class="text-white opacity-75">Pronto agregaremos nuevas opciones a nuestro catálogo.</p>
                </div>
            </div>
        @endif
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
                    <li><a href="{{ route('catalogue') }}" class="text-white opacity-75">Habitaciones</a></li>
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
