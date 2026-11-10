<!doctype html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HotelPro - Contáctanos</title>

    <!-- Bootstrap CSS v5.3.8 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <!-- Bootstrap Icons v1.13.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
</head>

<body>

<!-- NAVBAR (Idéntica al Home) -->
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
                        <a class="nav-link nav-link-hotel active" href="{{ route('contactus') }}">Contáctanos</a>
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
            <span class="feature-badge mb-3"><span class="badge-dot"></span> Estamos para servirle</span>
            <h1 class="display-4 text-white" style="font-family: 'Playfair Display', Georgia, serif;">Contáctanos</h1>
            <p class="text-secondary mx-auto mt-2" style="max-width: 600px;">¿Tiene alguna duda o solicitud especial? Nuestro equipo en Medellín le atenderá de inmediato</p>
        </div>
    </section>

    <!-- FORMULARIO Y DATOS DE CONTACTO -->
    <section class="py-5">
        <div class="container py-4" style="max-width: 900px;">

            @if(session('success'))
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'success',
                            title: '{{ session("success") }}',
                            showConfirmButton: false,
                            timer: 4000,
                            timerProgressBar: true,
                            background: '#171a1f',
                            color: '#ffffff'
                        });
                    });
                </script>
            @endif

            <div class="contact-card p-4 p-md-5 shadow-lg">
                <div class="row g-5">
                    <!-- Información rápida lateral -->
                    <div class="col-lg-5 border-end border-secondary border-opacity-25">
                        <h3 class="text-white mb-4" style="font-family: 'Playfair Display', Georgia, serif;">Información</h3>
                        <p class="text-secondary small mb-4">No dude en ponerse en contacto con nosotros a través de cualquiera de estos canales oficiales:</p>

                        <ul class="list-unstyled footer-contact d-flex flex-column gap-3">
                            <li class="d-flex align-items-center gap-3">
                                <span class="contact-icon fs-5">✉</span>
                                <div>
                                    <small class="text-muted d-block uppercase" style="font-size: 0.7rem; letter-spacing: 1px;">Correo Electrónico</small>
                                    <span class="text-white">reservas@hotelpro.com</span>
                                </div>
                            </li>
                            <li class="d-flex align-items-center gap-3">
                                <span class="contact-icon fs-5">📞</span>
                                <div>
                                    <small class="text-muted d-block uppercase" style="font-size: 0.7rem; letter-spacing: 1px;">Teléfono / WhatsApp</small>
                                    <span class="text-white">+57 322 687 80 17</span>
                                </div>
                            </li>
                            <li class="d-flex align-items-center gap-3">
                                <span class="contact-icon fs-5">📍</span>
                                <div>
                                    <small class="text-muted d-block uppercase" style="font-size: 0.7rem; letter-spacing: 1px;">Ubicación</small>
                                    <span class="text-white">Medellín, Colombia</span>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <!-- Formulario -->
                    <div class="col-lg-7">
                        <h3 class="text-white mb-4" style="font-family: 'Playfair Display', Georgia, serif;">Envíenos un mensaje</h3>
                        <form action="#" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Nombre Completo</label>
                                <input type="text" class="form-control" id="name" name="name" required placeholder="Ej. Carlos Mendoza">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Correo Electrónico</label>
                                <input type="email" class="form-control" id="email" name="email" required placeholder="correo@ejemplo.com">
                            </div>
                            <div class="col-md-6">
                                <label for="name" class="form-label">Teléfono (Opcional)</label>
                                <input type="text" name="phone" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="subject" class="form-label">Asunto</label>
                                <input type="text" class="form-control" id="subject" name="subject" required placeholder="Ej. Consulta sobre Suite Presidencial">
                            </div>
                            <div class="mb-4">
                                <label for="message" class="form-label">Mensaje</label>
                                <textarea class="form-control" id="message" name="message" rows="4" required placeholder="Escriba su mensaje detalladamente..."></textarea>
                            </div>
                            <button type="submit" class="btn btn-gold-solid w-100 py-3">Enviar Mensaje</button>
                        </form>
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
            <a href="{{ route('privacy.policy') }}" target="_blank" class="text-gold text-decoration-none">Política de Privacidad y Tratamiento de Datos</a>
        </div>
    </div>
</footer>

<!-- Bootstrap JavaScript Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
