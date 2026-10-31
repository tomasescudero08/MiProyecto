<!doctype html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HotelPro - Iniciar Sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <style>
        body { background-color: #121519; color: #e0e0e0; font-family: 'Montserrat', sans-serif; }
        .auth-card { background-color: #171a1f; border: 1px solid rgba(212, 175, 55, 0.3); border-radius: 8px; box-shadow: 0 15px 35px rgba(0,0,0,0.6); }
        .form-control { background-color: #121519; border: 1px solid rgba(255,255,255,0.15); color: #fff; }
        .form-control:focus { background-color: #121519; border-color: #d4af37; color: #fff; box-shadow: 0 0 0 0.25rem rgba(212, 175, 55, 0.25); }
        .form-check-input:checked { background-color: #d4af37; border-color: #d4af37; }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center min-vh-100 py-5">

<div class="container" style="max-width: 450px;">
    <div class="text-center mb-4">
        <a class="brand-hotel text-decoration-none fs-2" href="{{ route('home') }}">
            Hotel<span>Pro</span>
        </a>
        <p class="text-white opacity-75 mt-2 small">Inicia sesión para gestionar tu cuenta y reservas</p>
    </div>

    <div class="auth-card p-4 p-md-5">
        @if (session('status'))
            <div class="alert alert-success text-small mb-4 text-white bg-dark border-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label text-white small text-uppercase fw-semibold">Correo Electrónico</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
                @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label text-white small text-uppercase fw-semibold">Contraseña</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4 d-flex justify-content-between align-items-center">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember_me">
                    <label class="form-check-label text-white small opacity-75" for="remember_me">
                        Recordarme
                    </label>
                </div>
                @if (Route::has('password.request'))
                    <a class="small text-warning text-decoration-none fw-semibold" href="{{ route('password.request') }}">
                        ¿Olvidaste tu contraseña?
                    </a>
                @endif
            </div>

            <button type="submit" class="btn btn-gold-solid w-100 py-2 mb-3">Iniciar Sesión</button>

            <div class="text-center">
                <a href="{{ route('register') }}" class="small text-white text-decoration-none opacity-75">¿No tienes cuenta? <span class="text-gold fw-semibold">Regístrate aquí</span></a>
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
