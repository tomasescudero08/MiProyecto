<!doctype html>
<html lang="es" data-bs-theme="dark">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Todas las Reseñas - HotelPro</title>

    <!-- Bootstrap CSS v5.3.8 -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
        crossorigin="anonymous"
    >
    <!-- Bootstrap Icons v1.13.1 -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
        rel="stylesheet"
        integrity="sha384-CK2SzKma4jA5H/MXDUU7i1TqZlCFaD4T01vtyDFvPlD97JQyS+IsSh1nI2EFbpyk"
        crossorigin="anonymous"
    >
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">

    <style>
        body {
            background-color: #121519;
            color: #e0e0e0;
            font-family: 'Montserrat', sans-serif;
        }
        .text-gold {
            color: #d4af37 !important;
        }
        .service-card-enhanced {
            background-color: #171a1f;
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 12px;
            transition: transform 0.3s ease, border-color 0.3s ease, box-shadow 0.3s ease;
        }
        .service-card-enhanced:hover {
            transform: translateY(-5px);
            border-color: rgba(212, 175, 55, 0.4);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.5);
        }
        .review-text-truncate {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
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

            <!-- Logo -->
            <a class="navbar-brand brand-hotel" href="{{ route('home') }}">
                Hotel<span>Pro</span>
            </a>

            <!-- Botón Responsive -->
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Menú -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link nav-link-hotel" href="{{ route('home') }}">Inicio</a>
                    </li>
                    <li class="nav-item">
                        @auth
                            <a class="nav-link nav-link-hotel {{ request()->routeIs('rooms.*') ? 'active' : '' }}" href="{{ route('rooms.index') }}">
                                Habitaciones (Admin)
                            </a>
                        @else
                            <a class="nav-link nav-link-hotel {{ request()->routeIs('catalogue') ? 'active' : '' }}" href="{{ route('catalogue') }}">
                                Habitaciones
                            </a>
                        @endauth
                    </li>

                    <li class="nav-item">
                        @auth
                            <a class="nav-link nav-link-hotel {{ request()->routeIs('services.*') ? 'active' : '' }}" href="{{ route('services.index') }}">
                                Servicios (Admin)
                            </a>
                        @else
                            <a class="nav-link nav-link-hotel {{ request()->routeIs('services.catalogue') ? 'active' : '' }}" href="{{ route('services.catalogue') }}">
                                Servicios
                            </a>
                        @endauth
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-hotel" href="{{ route('aboutus') }}">Sobre Nosotros</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-hotel active" href="{{ route('reviews.public') }}">Opiniones</a>
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
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Iniciar Sesión</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn btn-gold text-dark ms-2" href="{{ route('register') }}" style="background-color: #d4af37;">Registrarse</a>
                        </li>
                    @endguest

                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                                Hola, {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end bg-dark">
                                <li><a class="dropdown-item text-white" href="{{ route('dashboard') }}">Panel de Control</a></li>
                                <li><a class="dropdown-item text-warning" href="{{ route('reservations.index') }}">Ver Todas las Reservas (Admin)</a></li>
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

<main class="py-4 pt-5 mt-2" style="min-height: 85vh;">
    <div class="container py-4">

        <!-- Cabecera de la Sección -->
        <div class="d-flex justify-content-between align-items-center mb-5 flex-wrap gap-3">
            <div>
                <span class="feature-badge mb-2">
                    <span class="badge-dot"></span> Experiencias Reales
                </span>
                <h1 class="section-title mb-0">Todas las Reseñas de nuestros Huéspedes</h1>
            </div>
            <a href="{{ route('home') }}" class="btn btn-gold-outline text-uppercase">Volver al Inicio</a>
        </div>

        <!-- Rejilla de Reseñas -->
        <div class="row g-4">
            @forelse($reviews as $review)
                <div class="col-md-6 col-lg-4">
                    <div class="service-card-enhanced p-4 h-100 d-flex flex-column justify-content-between text-start">
                        <div>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="text-warning fs-6">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $review->rating) ★ @else ☆ @endif
                                    @endfor
                                    <span class="text-white opacity-50 ms-1 small">({{ $review->rating }}.0)</span>
                                </div>
                                <span class="badge bg-dark text-warning border border-warning" style="font-size: 0.7rem;">Verificada</span>
                            </div>
                            <p class="service-desc mb-4 review-text-truncate text-white opacity-75" style="font-style: italic;">
                                &ldquo;{{ $review->comment }}&rdquo;
                            </p>
                        </div>

                        <div>
                            <hr class="border-secondary opacity-25 my-3">
                            <div class="d-flex justify-content-between align-items-end">
                                <div>
                                    <h6 class="text-white mb-1 fw-bold">{{ $review->guest_name }}</h6>
                                    <small class="text-white opacity-50 d-block">
                                        @if($review->room) Habitación: {{ $review->room->title }}
                                        @elseif($review->service) Servicio: {{ $review->service->name }}
                                        @else Experiencia General @endif
                                    </small>
                                </div>
                                <!-- Botón Leer Reseña -->
                                <button type="button" class="btn btn-gold-outline btn-sm px-3" data-bs-toggle="modal" data-bs-target="#userReviewModal{{ $review->id }}">
                                    <i class="bi bi-eye-fill me-1"></i> Leer
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal para Leer Reseña Completa -->
                <div class="modal fade" id="userReviewModal{{ $review->id }}" tabindex="-1" aria-labelledby="userReviewLabel{{ $review->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content modal-content-hotel">
                            <div class="modal-header border-bottom border-secondary">
                                <h5 class="modal-title text-gold" id="userReviewLabel{{ $review->id }}">
                                    <i class="bi bi-star-fill me-2 text-warning"></i> Opinión de {{ $review->guest_name }}
                                </h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <p class="text-white opacity-75 mb-1">
                                        <strong>Evaluación:</strong>
                                        <span class="text-warning">
                                            @for($i = 1; $i <= 5; $i++)
                                                @if($i <= $review->rating) ★ @else ☆ @endif
                                            @endfor
                                        </span>
                                        ({{ $review->rating }}.0 / 5.0)
                                    </p>
                                    <p class="text-white opacity-75 mb-1">
                                        <strong>Categoría:</strong>
                                        @if($review->room) Habitación: {{ $review->room->title }}
                                        @elseif($review->service) Servicio: {{ $review->service->name }}
                                        @else Experiencia General @endif
                                    </p>
                                    <p class="text-white opacity-75 mb-0"><small><strong>Publicado el:</strong> {{ $review->created_at->format('d/m/Y') }}</small></p>
                                </div>
                                <hr class="border-secondary opacity-25">
                                <div class="p-3 bg-dark rounded border border-secondary border-opacity-25">
                                    <h6 class="text-gold mb-2">Comentario Completo:</h6>
                                    <p class="text-white opacity-75 mb-0 text-break" style="white-space: pre-line; font-style: italic;">
                                        &ldquo;{{ $review->comment }}&rdquo;
                                    </p>
                                </div>
                            </div>
                            <div class="modal-footer border-top border-secondary">
                                <button type="button" class="btn btn-outline-light btn-sm" data-bs-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <i class="bi bi-chat-square-quote display-4 text-warning d-block mb-3"></i>
                    <p class="text-muted fs-5">Aún no hay reseñas registradas para mostrar.</p>
                </div>
            @endforelse
        </div>

        <!-- Paginación -->
        <div class="mt-5 d-flex justify-content-center">
            {{ $reviews->links() }}
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
                <p class="footer-description">
                    Tu refugio de lujo definitivo para descubrir la máxima comodidad, elegancia y experiencias inolvidables.
                </p>
            </div>

            <div class="col-lg-2 col-md-6 ms-lg-auto">
                <h5 class="footer-heading mb-3">Navegación</h5>
                <ul class="list-unstyled footer-links">
                    <li><a href="{{ route('home') }}">Inicio</a></li>
                    <li><a href="{{ route('catalogue') }}">Habitaciones</a></li>
                    <li><a href="{{ route('services.catalogue') }}">Servicios</a></li>
                    <li><a href="{{ route('aboutus') }}">Sobre Nosotros</a></li>
                    <li><a href="{{ route('contactus') }}">Contáctanos</a></li>
                </ul>
            </div>

            <div class="col-lg-3 col-md-6">
                <h5 class="footer-heading mb-3">Contacto</h5>
                <ul class="list-unstyled footer-contact">
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
            <p class="footer-copyright mb-0">
                &copy; {{ date('Y') }} HotelPro. Todos los derechos reservados.
            </p>
        </div>
    </div>
</footer>

<!-- Bootstrap JavaScript Bundle -->
<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
    crossorigin="anonymous"
></script>
</body>
</html>
