<!doctype html>
<html lang="en" data-bs-theme="light">
<head>
    <!-- Required meta tags: charset must come first -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HotelPro</title>

    <!-- Boot   strap CSS v5.3.8 -->
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
</head>

<body>

<!-- NAVBAR FLOTANTE -->
<header>
    <nav class="navbar navbar-expand-lg navbar-dark navbar-hotel">
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
                        <a class="nav-link nav-link-hotel active" aria-current="page" href="{{ route('home') }}">Inicio</a>
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
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Iniciar Sesión</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn btn-gold text-dark ms-2" href="{{ route('register') }}" style="background-color: #d4af37;">Registrarse</a>
                        </li>
                    @endguest

                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle active text-gold fw-semibold" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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

<main>
    <!-- HERO SECTION DINÁMICO (CARRUSEL) -->
    <section class="hero-section-wrapper">
        <div id="hotelHeroCarousel" class="carousel slide carousel-fade hero-carousel" data-bs-ride="carousel" data-bs-interval="5000">

            <div class="carousel-indicators mb-4">
                @foreach($rooms as $index => $roomItem)
                    <button type="button" data-bs-target="#hotelHeroCarousel" data-bs-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}" aria-current="{{ $index == 0 ? 'true' : 'false' }}" aria-label="Slide {{ $index + 1 }}"></button>
                @endforeach
            </div>

            <div class="carousel-inner">
                @forelse($rooms as $index => $roomItem)
                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}" style="background-image: url('{{ $roomItem->image_url ?? 'https://images.unsplash.com/photo-1590490360182-c33d57733427?q=80&w=1920&auto=format&fit=crop' }}');">
                        <div class="carousel-caption d-block text-center">
                            <span class="hero-tag">{{ $roomItem->badge_tag ?? 'Experiencia Exclusiva' }}</span>
                            <h1 class="hero-title">{{ $roomItem->title }}</h1>
                            <p class="hero-description mx-auto col-lg-8">
                                {{ $roomItem->short_description ?? $roomItem->description }}
                            </p>
                            <div class="d-flex align-items-center justify-content-center gap-4 mt-3">
                                <div class="hero-price">${{ number_format($roomItem->price_per_night ?? $roomItem->price, 0) }} <span>/ noche</span></div>
                                <a href="{{ route('reservations.create', $roomItem->id) }}" class="btn btn-hero">Reservar Habitación</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="carousel-item active" style="background-image: url('https://images.unsplash.com/photo-1590490360182-c33d57733427?q=80&w=1920&auto=format&fit=crop');">
                        <div class="carousel-caption d-block text-center">
                            <span class="hero-tag">Bienvenido</span>
                            <h1 class="hero-title">HotelPro de Lujo</h1>
                            <p class="hero-description mx-auto col-lg-8">Pronto agregaremos habitaciones destacadas.</p>
                        </div>
                    </div>
                @endforelse
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#hotelHeroCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Anterior</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#hotelHeroCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Siguiente</span>
            </button>

        </div>
    </section>

    <!-- SECCIÓN DE CARACTERÍSTICAS -->
    <section class="hotel-feature-section py-5">
        <div class="container py-lg-5">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <div class="feature-badge mb-3">
                        <span class="badge-dot"></span> Experiencia Única
                    </div>
                    <h2 class="feature-title mb-4">
                        Vive una Estancia de <span class="text-gold">Lujo Inigualable</span>
                    </h2>
                    <p class="feature-description mb-4">
                        Disfruta de instalaciones de clase mundial, gastronomía de autor y un servicio personalizado diseñado para superar todas tus expectativas en cada momento.
                    </p>
                    <div class="d-flex flex-wrap gap-3 mb-5">
                        <a class="nav-link nav-link-hotel {{ request()->routeIs('catalogue') ? 'active' : '' }}" href="{{ route('catalogue') }}">
                            @auth Gestionar habitaciones @else Ver habitaciones @endauth
                        </a>
                        <a class="nav-link nav-link-hotel {{ request()->routeIs('services.catalogue') ? 'active' : '' }}" href="{{ route('services.catalogue') }}">
                            @auth Gestionar servicios @else Ver servicios @endauth
                        </a>
                    </div>
                    <div class="row text-white border-top border-secondary pt-4 g-4">
                        <div class="col-4">
                            <h3 class="stat-number mb-1">+50</h3>
                            <p class="stat-label mb-0">Habitaciones</p>
                        </div>
                        <div class="col-4">
                            <h3 class="stat-number mb-1">24/7</h3>
                            <p class="stat-label mb-0">Atención</p>
                        </div>
                        <div class="col-4">
                            <h3 class="stat-number mb-1">100%</h3>
                            <p class="stat-label mb-0">Satisfacción</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="feature-image-wrapper position-relative">
                        <img src="https://images.unsplash.com/photo-1618773928121-c32242e63f39?q=80&w=1200&auto=format&fit=crop"
                             alt="Hotel Principal"
                             class="img-fluid rounded-4 shadow-lg w-100 feature-img">
                        <div class="floating-badge p-3 rounded-3">
                            <div class="d-flex align-items-center gap-3">
                                <div class="icon-box text-gold">
                                    <i class="bi bi-cash-coin"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0 text-white fw-bold">¡TARIFAS ESPECIALES!</h6>
                                    <small class="text-warning">Hasta 25% de descuento directo</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECCIÓN DE SERVICIOS DINÁMICOS (MÁXIMO 4 ELEMENTOS: 3 DINÁMICOS + 1 "Y MUCHOS MÁS") -->
    <section class="hotel-services-section py-5">
        <div class="container py-4">
            <div class="text-center mb-5">
                <span class="feature-badge mb-2">
                    <span class="badge-dot"></span> Amenidades Premium
                </span>
                <h2 class="section-title">Servicios de Clase Mundial</h2>
                <p class="section-subtitle mx-auto">Diseñados para brindar una experiencia inigualable durante toda tu estancia.</p>
            </div>

            <div class="row g-4">
                @php
                    $limitedServices = $services->take(3);
                @endphp

                @foreach($limitedServices as $service)
                    <div class="col-md-6 col-lg-3">
                        <div class="service-card p-4 h-100 text-center">
                            <div class="service-icon mb-3">{{ $service->icon ?? '✦' }}</div>
                            <h5 class="service-title">{{ $service->name }}</h5>
                            <p class="service-desc">{{ $service->description }}</p>
                        </div>
                    </div>
                @endforeach

                <!-- Tarjeta 4: Y muchos más -->
                <div class="col-md-6 col-lg-3">
                    <a href="{{ route('services.catalogue') }}" class="text-decoration-none h-100 d-block">
                        <div class="service-card p-4 h-100 text-center d-flex flex-column justify-content-center align-items-center" style="border: 2px dashed #d4af37; background-color: rgba(212, 175, 55, 0.03);">
                            <div class="service-icon mb-3" style="color: #d4af37;"><i class="bi bi-plus-circle"></i></div>
                            <h5 class="service-title text-warning mb-2">Y muchos más...</h5>
                            <p class="service-desc text-muted mb-0">Explora todas nuestras amenidades exclusivas.</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- SECCIÓN DE HABITACIONES DESTACADAS (TARJETAS DINÁMICAS) -->
    <section class="hotel-rooms-section py-5">
        <div class="container py-4">
            <div class="d-flex justify-content-between align-items-end mb-5 flex-wrap gap-3">
                <div>
                    <span class="feature-badge mb-2">
                        <span class="badge-dot"></span> Exclusividad
                    </span>
                    <h2 class="section-title mb-0">Habitaciones Destacadas</h2>
                </div>
                <a href="{{ route('catalogue') }}" class="btn btn-gold-outline">Ver Todas las habitaciones</a>
            </div>

            <div class="row g-4">
                @forelse($rooms as $roomItem)
                    <div class="col-sm-6 col-lg-4">
                        <div class="room-card h-100">
                            <div class="room-img-container position-relative">
                                <img src="{{ $roomItem->image_url ?? 'https://images.unsplash.com/photo-1590490360182-c33d57733427?q=80&w=600&auto=format&fit=crop' }}" alt="{{ $roomItem->title }}" class="room-img">
                                <span class="badge-tag">{{ $roomItem->badge_tag ?? 'Destacada' }}</span>
                            </div>
                            <div class="room-card-body p-3 d-flex flex-column justify-content-between">
                                <div>
                                    <div class="room-stars mb-1">
                                        ★★★★★ <span class="rating-text">({{ $roomItem->rating ?? '5.0' }})</span>
                                    </div>
                                    <h5 class="room-name mb-1">{{ $roomItem->title }}</h5>
                                    <p class="room-category mb-2">{{ $roomItem->category->name ?? 'Suite' }}</p>
                                    <p class="room-short-desc">{{ $roomItem->short_description }}</p>
                                </div>
                                <div class="d-flex align-items-center justify-content-between mt-3 pt-2 border-top border-dark-subtle">
                                    <div class="room-price">${{ number_format($roomItem->price_per_night ?? $roomItem->price, 0) }} <small>/ noche</small></div>
                                    <a href="{{ route('reservations.create', $roomItem->id) }}" class="btn btn-room-buy">Reservar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center text-muted">
                        <p>No hay habitaciones disponibles en este momento.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- SECCIÓN DE RESEÑAS DESTACADAS (CON EL MISMO CONTENEDOR Y ESTILO DE SERVICIOS) -->
    <section class="hotel-services-section py-5">
        <div class="container py-4">
            <div class="d-flex justify-content-between align-items-center mb-5 flex-wrap gap-3">
                <div>
        <span class="feature-badge mb-2">
            <span class="badge-dot"></span> Opiniones
        </span>
                    <h2 class="section-title mb-0">Lo que dicen nuestros huéspedes</h2>
                </div>

                <div class="d-flex gap-3 align-items-center flex-wrap">
                    <!-- Botón para que cualquier huésped escriba una reseña -->
                    <button type="button" class="btn fw-bold text-uppercase px-4 py-2" data-bs-toggle="modal" data-bs-target="#reviewModal" style="background-color: #d4af37; color: #121212; border: none;">
                        <i class="bi bi-pencil-square me-1"></i> Escribir Reseña
                    </button>

                    @auth
                        @if(Auth::user()->is_admin)
                            <a href="{{ route('reviews.index') }}" class="btn btn-gold-outline text-uppercase">GESTIONAR RESEÑAS</a>
                        @else
                            <a href="{{ route('reviews.public') }}" class="btn btn-gold-outline text-uppercase">VER TODAS LAS RESEÑAS</a>
                        @endif
                    @else
                        <a href="{{ route('reviews.public') }}" class="btn btn-gold-outline text-uppercase">VER TODAS LAS RESEÑAS</a>
                    @endauth
                </div>
            </div>

            <div class="row g-4">
                @forelse($reviews as $review)
                    <div class="col-md-4 mb-4">
                        <div class="service-card p-4 h-100 d-flex flex-column justify-content-between text-start">
                            <div>
                                <div class="mb-2" style="color: #d4af37;">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $review->rating) ★ @else ☆ @endif
                                    @endfor
                                    <span class="text-white ms-1">({{ $review->rating }}.0)</span>
                                </div>
                                <p class="service-desc mb-4" style="font-style: italic;">&ldquo;{{ $review->comment }}&rdquo;</p>
                            </div>
                            <div>
                                <hr style="border-color: #333;">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="text-white mb-0 fw-bold">{{ $review->guest_name }}</h6>
                                        <small class="text-white">
                                            @if($review->room) Habitación: {{ $review->room->title }}
                                            @elseif($review->service) Servicio: {{ $review->service->name }}
                                            @else General @endif
                                        </small>
                                    </div>
                                    <span class="badge bg-dark text-warning border border-warning" style="font-size: 0.7rem;">Verificada</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <p class="text-white">Aún no hay reseñas registradas. ¡Sé el primero en dejarnos tu opinión!</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
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
            <a href="{{ route('privacy.policy') }}" target="_blank" class="text-gold text-decoration-none">Política de Privacidad y Tratamiento de Datos</a>
        </div>
    </div>
</footer>

<!-- Bootstrap JavaScript Bundle -->
<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
    crossorigin="anonymous"
></script>
<!-- Modal para Agregar Reseña -->
<div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-white shadow-lg" style="background-color: #1a1a1a; border: 1px solid #333;">
            <div class="modal-header border-bottom border-secondary">
                <h5 class="modal-title fw-bold" id="reviewModalLabel" style="color: #d4af37;">Comparte tu Experiencia</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('reviews.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="guest_name" class="form-label text-light">Tu Nombre *</label>
                        <input type="text" class="form-control bg-dark text-white border-secondary" id="guest_name" name="guest_name" required placeholder="Ej. Carlos Pérez">
                    </div>

                    <div class="mb-3">
                        <label for="guest_email" class="form-label text-light">Correo Electrónico (Opcional)</label>
                        <input type="email" class="form-control bg-dark text-white border-secondary" id="guest_email" name="guest_email" placeholder="correo@ejemplo.com">
                    </div>

                    <div class="mb-3">
                        <label for="rating" class="form-label text-light">Calificación (Estrellas) *</label>
                        <select class="form-select bg-dark text-white border-secondary" id="rating" name="rating" required>
                            <option value="5">★★★★★ (5 - Excelente)</option>
                            <option value="4">★★★★☆ (4 - Muy bueno)</option>
                            <option value="3">★★★☆☆ (3 - Bueno)</option>
                            <option value="2">★★☆☆☆ (2 - Regular)</option>
                            <option value="1">★☆☆☆☆ (1 - Malo)</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="comment" class="form-label text-light">Tu Opinión / Comentario *</label>
                        <textarea class="form-control bg-dark text-white border-secondary" id="comment" name="comment" rows="4" required placeholder="¿Cómo fue tu estancia en HotelPro?"></textarea>
                    </div>
                </div>
                <div class="modal-footer border-top border-secondary">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn fw-bold px-4" style="background-color: #d4af37; color: #121212;">Publicar Reseña</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
