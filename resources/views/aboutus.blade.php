<!doctype html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HotelPro - Sobre Nosotros</title>

    <!-- Bootstrap CSS v5.3.8 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <!-- Bootstrap Icons v1.13.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
</head>

<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-dark navbar-hotel-internal py-3">
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
    <!-- ENCABEZADO DE SECCIÓN -->
    <section class="page-header text-center">
        <div class="container">
            <span class="feature-badge mb-3"><span class="badge-dot"></span> Nuestra Esencia</span>
            <h1 class="display-4 text-white" style="font-family: 'Playfair Display', Georgia, serif;">Sobre HotelPro</h1>
            <p class="text-secondary mx-auto mt-2" style="max-width: 600px;">Un refugio de lujo definitivo para descubrir la máxima comodidad, elegancia y experiencias inolvidables.</p>
        </div>
    </section>

    <!-- CONTENIDO PRINCIPAL SOBRE NOSOTROS -->
    <section class="py-5">
        <div class="container py-4">
            <div class="row align-items-center g-5 mb-5">
                <div class="col-lg-6">
                    <h2 class="text-white mb-4" style="font-family: 'Playfair Display', Georgia, serif; font-size: 2.5rem;">
                        Tradición de Lujo y <span class="text-gold">Hospitalidad Exclusiva</span>
                    </h2>
                    <p class="text-secondary lh-lg mb-4">
                        En HotelPro nos dedicamos a redefinir los estándares de la hostelería de alta gama. Ubicados en el corazón de Medellín, combinamos arquitectura contemporánea, acabados de primer nivel y un servicio personalizado que anticipa cada uno de tus deseos.
                    </p>
                    <p class="text-secondary lh-lg">
                        Cada espacio ha sido cuidadosamente diseñado para ofrecerte un ambiente de absoluta privacidad, confort y distinción durante toda tu estancia.
                    </p>
                </div>
                <div class="col-lg-6">
                    <img src="https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?q=80&w=1000&auto=format&fit=crop" alt="Hotel Interior" class="img-fluid rounded-4 shadow-lg w-100 border border-secondary border-opacity-25">
                </div>
            </div>

            <!-- Galería de imágenes de apoyo -->
            <div class="row g-4 mt-4">
                <div class="col-md-4">
                    <div class="about-card p-3 h-100 text-center">
                        <img src="https://images.unsplash.com/photo-1540555700478-4be289fbecef?q=80&w=600&auto=format&fit=crop" alt="Spa" class="img-fluid rounded mb-3" style="height: 200px; object-fit: cover; width: 100%;">
                        <h5 class="text-white mb-2" style="font-family: 'Playfair Display', Georgia, serif;">Bienestar y Spa</h5>
                        <p class="text-secondary small mb-0">Espacios diseñados para la relajación total del cuerpo y la mente.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="about-card p-3 h-100 text-center">
                        <img src="https://images.unsplash.com/photo-1571896349842-33c89424de2d?q=80&w=600&auto=format&fit=crop" alt="Piscina" class="img-fluid rounded mb-3" style="height: 200px; object-fit: cover; width: 100%;">
                        <h5 class="text-white mb-2" style="font-family: 'Playfair Display', Georgia, serif;">Piscina Infinita</h5>
                        <p class="text-secondary small mb-0">Disfrute de vistas panorámicas incomparables mientras descansa.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="about-card p-3 h-100 text-center">
                        <img src="https://images.unsplash.com/photo-1551882547-ff40c63fe5fa?q=80&w=600&auto=format&fit=crop" alt="Gastronomía" class="img-fluid rounded mb-3" style="height: 200px; object-fit: cover; width: 100%;">
                        <h5 class="text-white mb-2" style="font-family: 'Playfair Display', Georgia, serif;">Alta Gastronomía</h5>
                        <p class="text-secondary small mb-0">Experiencias culinarias de autor a cargo de chefs internacionales.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<!-- FOOTER (Idéntico al Home) -->
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
                    <li><a href="{{ route('services.index') }}">Servicios</a></li>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
