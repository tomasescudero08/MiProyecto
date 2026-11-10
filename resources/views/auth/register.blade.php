<!doctype html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HotelPro - Registro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <style>
        body { background-color: #121519; color: #e0e0e0; font-family: 'Montserrat', sans-serif; }
        .auth-card { background-color: #171a1f; border: 1px solid rgba(212, 175, 55, 0.3); border-radius: 8px; box-shadow: 0 15px 35px rgba(0,0,0,0.6); }
        .form-control { background-color: #121519; border: 1px solid rgba(255,255,255,0.15); color: #fff; }
        .form-control:focus { background-color: #121519; border-color: #d4af37; color: #fff; box-shadow: 0 0 0 0.25rem rgba(212, 175, 55, 0.25); }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center min-vh-100 py-5">

<div class="container" style="max-width: 450px;">
    <div class="text-center mb-4">
        <a class="brand-hotel text-decoration-none fs-2" href="{{ route('home') }}">
            Hotel<span>Pro</span>
        </a>
        <p class="text-white opacity-75 mt-2 small">Crea una cuenta para disfrutar de experiencias exclusivas</p>
    </div>

    <div class="auth-card p-4 p-md-5">
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label text-white small text-uppercase fw-semibold">Nombre Completo</label>
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autofocus autocomplete="name">
                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label text-white small text-uppercase fw-semibold">Correo Electrónico</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="username">
                @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label text-white small text-uppercase fw-semibold">Contraseña</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password_confirmation" class="form-label text-white small text-uppercase fw-semibold">Confirmar Contraseña</label>
                <input id="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" required autocomplete="new-password">
                @error('password_confirmation')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input @error('terms') is-invalid @enderror" id="terms" name="terms" required>
                <label class="form-check-label small text-white opacity-75" for="terms">
                    Acepto la <a href="{{ route('privacy.policy') }}" target="_blank" class="text-gold text-decoration-none">Política de Tratamiento de Datos Personales</a> conforme a la Ley 1581 de 2012.
                </label>
                @error('terms')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-gold-solid w-100 py-2 mb-3">Registrarse</button>

            <div class="text-center">
                <a href="{{ route('login') }}" class="small text-white text-decoration-none opacity-75">¿Ya tienes cuenta? <span class="text-gold fw-semibold">Inicia sesión</span></a>
            </div>
        </form>
    </div>

    <div class="text-center mt-4">
        <a href="{{ route('home') }}" class="text-white small text-decoration-none opacity-75"><i class="bi bi-arrow-left me-1"></i> Volver al inicio</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
