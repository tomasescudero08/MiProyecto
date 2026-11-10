<!doctype html>
<html lang="es" data-bs-theme="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HotelPro - Perfil de Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <style>
        body { background-color: #121519; color: #e0e0e0; font-family: 'Montserrat', sans-serif; }
        .auth-card { background-color: #171a1f; border: 1px solid rgba(212, 175, 55, 0.3); border-radius: 8px; box-shadow: 0 15px 35px rgba(0,0,0,0.6); }
        .form-control { background-color: #121519; border: 1px solid rgba(255,255,255,0.25); color: #fff; }
        .form-control:focus { background-color: #121519; border-color: #d4af37; color: #fff; box-shadow: 0 0 0 0.25rem rgba(212, 175, 55, 0.25); }
        .text-gold { color: #d4af37 !important; }
    </style>
</head>
<body class="py-5">

<div class="container" style="max-width: 700px;">

    <!-- Encabezado / Logo -->
    <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom border-secondary">
        <a class="brand-hotel text-decoration-none fs-3" href="{{ route('dashboard') }}">
            Hotel<span>Pro</span>
        </a>
        <a href="{{ route('dashboard') }}" class="btn btn-outline-light btn-sm">
            <i class="bi bi-house me-1"></i> Volver al Panel
        </a>
    </div>

    <h2 class="text-white fw-bold mb-4 fs-4">Perfil de Usuario y Privacidad</h2>

    <div class="space-y-6">

        <!-- 1. Actualizar Información de Perfil -->
        <div class="auth-card p-4 p-md-4 mb-4">
            <h4 class="text-gold fs-6 fw-semibold mb-3">Información de Perfil</h4>
            @include('profile.partials.update-profile-information-form')
        </div>

        <!-- 2. Actualizar Contraseña -->
        <div class="auth-card p-4 p-md-4 mb-4">
            <h4 class="text-gold fs-6 fw-semibold mb-3">Actualizar Contraseña</h4>
            @include('profile.partials.update-password-form')
        </div>

        <!-- 3. Eliminar Cuenta (Ley 1581 / Habeas Data) -->
        <div class="auth-card p-4 p-md-4 mb-4 border-danger">
            <h4 class="text-danger fs-6 fw-semibold mb-3">Zona de Riesgo: Gestión de Cuenta</h4>
            @include('profile.partials.delete-user-form')
        </div>

    </div>

    <div class="text-center mt-5">
        <p class="small text-white opacity-75">&copy; {{ date('Y') }} HotelPro. Todos los derechos reservados.</p>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
