<!doctype html>
<html lang="es" data-bs-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HotelPro - Contáctanos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <style>
        body { background-color: #121519; color: #e0e0e0; font-family: 'Montserrat', sans-serif; }
        .form-control { background-color: #121519; border: 1px solid rgba(255,255,255,0.15); color: #fff; }
        .form-control:focus { background-color: #121519; border-color: #d4af37; color: #fff; box-shadow: 0 0 0 0.25rem rgba(212, 175, 55, 0.25); }
        .contact-card { background-color: #171a1f; border: 1px solid rgba(212, 175, 55, 0.3); border-radius: 8px; }
    </style>
</head>
<body>

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
                    <li class="nav-item"><a class="nav-link nav-link-hotel" href="{{ route('catalogue') }}">Habitaciones</a></li>
                    <li class="nav-item"><a class="nav-link nav-link-hotel" href="{{ route('services.index') }}">Servicios</a></li>
                    <li class="nav-item"><a class="nav-link nav-link-hotel" href="{{ route('aboutus') }}">Sobre Nosotros</a></li>
                    <li class="nav-item"><a class="nav-link nav-link-hotel active" href="{{ route('contactus') }}">Contáctanos</a></li>
                    @guest
                        <li class="nav-item"><a class="nav-link text-white" href="{{ route('login') }}">Iniciar Sesión</a></li>
                        <li class="nav-item"><a class="nav-link btn btn-gold text-dark ms-2" href="{{ route('register') }}" style="background-color: #d4af37;">Registrarse</a></li>
                    @endguest
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown">Hola, {{ Auth::user()->name }}</a>
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
                <div class="d-flex"><a href="{{ route('rooms.index') }}" class="btn btn-reservar">Reservar ahora</a></div>
            </div>
        </div>
    </nav>
</header>

<main class="py-5" style="background-color: #121519; min-height: 80vh;">
    <div class="container py-4">
        <div class="text-center mb-5">
            <span class="feature-badge mb-2"><span class="badge-dot"></span> Atencion al Cliente</span>
            <h1 class="section-title">Ponte en Contacto</h1>
            <p class="section-subtitle mx-auto text-white opacity-75">Envíanos tus preguntas o solicitudes y te responderemos a la brevedad.</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                @if(session('success'))
                    <div class="alert alert-success bg-dark text-white border-success mb-4" role="alert">
                        <i class="bi bi-check-circle-fill text-success me-2"></i> {{ session('success') }}
                    </div>
                @endif

                <div class="contact-card p-4 p-md-5">
                    <form action="{{ route('contact.store') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label text-white small text-uppercase fw-semibold">Nombre Completo</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-white small text-uppercase fw-semibold">Correo Electrónico</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-white small text-uppercase fw-semibold">Teléfono (Opcional)</label>
                                <input type="text" name="phone" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-white small text-uppercase fw-semibold">Asunto</label>
                                <input type="text" name="subject" class="form-control">
                            </div>
                            <div class="col-12">
                                <label class="form-label text-white small text-uppercase fw-semibold">Mensaje</label>
                                <textarea name="message" rows="5" class="form-control" required></textarea>
                            </div>
                            <div class="col-12 mt-4 text-end">
                                <button type="submit" class="btn btn-gold-solid px-5">Enviar Mensaje</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
