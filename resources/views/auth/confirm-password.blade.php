<!doctype html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HotelPro - Confirmar Contraseña</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <style>
        body { background-color: #121519; color: #e0e0e0; font-family: 'Montserrat', sans-serif; }
        .auth-card { background-color: #171a1f; border: 1px solid rgba(212, 175, 55, 0.3); border-radius: 8px; box-shadow: 0 15px 35px rgba(0,0,0,0.6); }
        .form-control { background-color: #121519; border: 1px solid rgba(255,255,255,0.25); color: #fff; }
        .form-control:focus { background-color: #121519; border-color: #d4af37; color: #fff; box-shadow: 0 0 0 0.25rem rgba(212, 175, 55, 0.25); }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center min-vh-100 py-5">

<div class="container" style="max-width: 450px;">
    <div class="text-center mb-4">
        <a class="brand-hotel text-decoration-none fs-2" href="{{ route('home') }}">
            Hotel<span>Pro</span>
        </a>
        <h3 class="text-white fw-bold mt-3 fs-4">Área Segura</h3>
        <p class="text-white small mt-2 opacity-75">
            Esta es un área segura de la aplicación. Por favor confirma tu contraseña antes de continuar.
        </p>
    </div>

    <div class="auth-card p-4 p-md-5">
        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <!-- Password -->
            <div class="mb-4">
                <label for="password" class="form-label text-white small text-uppercase fw-semibold">Contraseña</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-gold-solid w-100 py-2 mb-3">
                Confirmar
            </button>

            <div class="text-center mt-3">
                <a href="{{ route('dashboard') }}" class="small text-white text-decoration-none opacity-75">
                    <i class="bi bi-arrow-left me-1"></i> Volver al panel
                </a>
            </div>
        </form>
    </div>

    <div class="text-center mt-4">
        <a href="{{ route('home') }}" class="text-white small text-decoration-none opacity-75"><i class="bi bi-house me-1"></i> Volver al inicio</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
