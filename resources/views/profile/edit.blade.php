<!doctype html>
<html lang="es" data-bs-theme="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HotelPro - Perfil de Usuario</title>
    <!-- Bootstrap CSS v5.3.8 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons v1.13.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <!-- SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <!-- Estilos personalizados -->
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <style>
        body { background-color: #121519; color: #e0e0e0; font-family: 'Montserrat', sans-serif; }
        .auth-card { background-color: #171a1f; border: 1px solid rgba(212, 175, 55, 0.3); border-radius: 8px; box-shadow: 0 15px 35px rgba(0,0,0,0.6); }
        .form-control { background-color: #121519; border: 1px solid rgba(255,255,255,0.25); color: #fff; padding: 0.75rem 1rem; border-radius: 6px; }
        .form-control:focus { background-color: #121519; border-color: #d4af37; color: #fff; box-shadow: 0 0 0 0.25rem rgba(212, 175, 55, 0.25); }
        .text-gold { color: #d4af37 !important; }
        .form-label { font-size: 0.85rem; letter-spacing: 0.5px; }

        /* Estilos oscuros personalizados para SweetAlert2 */
        .swal2-popup-hotel {
            background-color: #171a1f !important;
            border: 1px solid rgba(212, 175, 55, 0.4) !important;
            color: #ffffff !important;
            border-radius: 10px !important;
        }
        .swal2-title-hotel { color: #d4af37 !important; }
        .swal2-confirm-hotel {
            background-color: #d4af37 !important;
            color: #121519 !important;
            font-weight: bold !important;
        }
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
            <h4 class="text-gold fs-5 fw-bold mb-2">Información de Perfil</h4>
            <p class="text-white small opacity-75 mb-4">Actualiza la información de tu cuenta y dirección de correo electrónico.</p>

            <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                @csrf
            </form>

            <form method="post" action="{{ route('profile.update') }}">
                @csrf
                @method('patch')

                <div class="mb-3">
                    <label for="name" class="form-label text-white text-uppercase fw-semibold">Nombre</label>
                    <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="email" class="form-label text-white text-uppercase fw-semibold">Correo Electrónico</label>
                    <input id="email" name="email" type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required autocomplete="username">
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                        <div>
                            <p class="text-sm mt-2 text-warning">
                                Tu dirección de correo electrónico no está verificada.
                                <button form="send-verification" class="btn btn-link text-gold p-0 m-0 align-baseline small">Haz clic aquí para reenviar el correo de verificación.</button>
                            </p>
                            @if (session('status') === 'verification-link-sent')
                                <p class="mt-2 font-medium text-sm text-success">
                                    Se ha enviado un nuevo enlace de verificación a tu correo electrónico.
                                </p>
                            @endif
                        </div>
                    @endif
                </div>

                <div class="d-flex align-items-center gap-4">
                    <button type="submit" class="btn btn-gold-solid px-4 py-2">Guardar Cambios</button>
                </div>
            </form>
        </div>

        <!-- 2. Actualizar Contraseña -->
        <div class="auth-card p-4 p-md-4 mb-4">
            <h4 class="text-gold fs-5 fw-bold mb-2">Actualizar Contraseña</h4>
            <p class="text-white small opacity-75 mb-4">Ingresa tu contraseña actual y define tu nueva clave de acceso.</p>

            <form id="updatePasswordForm" method="post" action="{{ route('password.update') }}">
                @csrf
                @method('put')

                <div class="mb-3">
                    <label for="update_password_current_password" class="form-label text-white text-uppercase fw-semibold">Contraseña Actual *</label>
                    <input id="update_password_current_password" name="current_password" type="password" class="form-control @error('current_password', 'updatePassword') is-invalid @enderror" required autocomplete="current-password">
                    @error('current_password', 'updatePassword')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="update_password_password" class="form-label text-white text-uppercase fw-semibold">Nueva Contraseña *</label>
                    <input id="update_password_password" name="password" type="password" class="form-control @error('password', 'updatePassword') is-invalid @enderror" required autocomplete="new-password">
                    @error('password', 'updatePassword')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="update_password_password_confirmation" class="form-label text-white text-uppercase fw-semibold">Confirmar Nueva Contraseña *</label>
                    <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="form-control @error('password_confirmation', 'updatePassword') is-invalid @enderror" required autocomplete="new-password">
                    <div id="passwordMismatchError" class="invalid-feedback" style="display: none;">Las contraseñas no coinciden.</div>
                    @error('password_confirmation', 'updatePassword')
                    <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex align-items-center gap-4">
                    <button type="submit" class="btn btn-gold-solid px-4 py-2">Actualizar Contraseña</button>
                </div>
            </form>
        </div>

        <!-- 3. Eliminar Cuenta (Ley 1581 / Habeas Data) -->
        <div class="auth-card p-4 p-md-4 mb-4 border-danger">
            <h4 class="text-danger fs-5 fw-bold mb-2">Zona de Riesgo: Gestión de Cuenta</h4>
            <p class="text-white small opacity-75 mb-3">
                Una vez eliminada su cuenta, sus datos personales de identificación serán anonimizados permanentemente. Los registros históricos de reservas se conservarán bajo estricta normativa legal de retención en Colombia.
            </p>

            <button type="button" class="btn btn-outline-danger btn-sm px-3 py-2" data-bs-toggle="modal" data-bs-target="#confirmUserDeletionModal">
                <i class="bi bi-trash3 me-1"></i> Solicitar eliminación de cuenta
            </button>
        </div>

    </div>

    <div class="text-center mt-5">
        <p class="small text-white opacity-75">&copy; {{ date('Y') }} HotelPro. Todos los derechos reservados.</p>
    </div>
</div>

<!-- Modal de Confirmación de Eliminación -->
<div class="modal fade" id="confirmUserDeletionModal" tabindex="-1" aria-labelledby="confirmUserDeletionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-dark text-white border-secondary">
            <div class="modal-header border-secondary">
                <h5 class="modal-title text-gold" id="confirmUserDeletionModalLabel">¿Confirma la eliminación de su cuenta?</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form method="post" action="{{ route('profile.destroy') }}">
                @csrf
                @method('delete')

                <div class="modal-body">
                    <p class="small text-white opacity-75">
                        Esta acción es irreversible y finalizará su sesión de inmediato. Por seguridad, ingrese su contraseña actual para confirmar la solicitud:
                    </p>

                    <div class="mb-3">
                        <label for="password_deletion" class="form-label small text-uppercase fw-semibold">Contraseña Actual</label>
                        <input id="password_deletion" name="password" type="password" class="form-control @error('password', 'userDeletion') is-invalid @enderror" placeholder="Ingrese su contraseña" required>
                        @error('password', 'userDeletion')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="modal-footer border-secondary">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger btn-sm">Sí, eliminar mi cuenta</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const passwordForm = document.getElementById('updatePasswordForm');
        const newPassword = document.getElementById('update_password_password');
        const confirmPassword = document.getElementById('update_password_password_confirmation');
        const mismatchError = document.getElementById('passwordMismatchError');

        // Validar coincidencia de contraseñas en cliente antes de enviar
        passwordForm.addEventListener('submit', function (e) {
            if (newPassword.value !== confirmPassword.value) {
                e.preventDefault();
                confirmPassword.classList.add('is-invalid');
                mismatchError.style.display = 'block';

                Swal.fire({
                    icon: 'error',
                    title: 'Contraseñas no coinciden',
                    text: 'La nueva contraseña y su confirmación deben ser exactamente iguales.',
                    customClass: {
                        popup: 'swal2-popup-hotel',
                        title: 'swal2-title-hotel',
                        confirmButton: 'swal2-confirm-hotel'
                    }
                });
            } else {
                confirmPassword.classList.remove('is-invalid');
                mismatchError.style.display = 'none';
            }
        });

        // Desactivar estado de error al escribir
        confirmPassword.addEventListener('input', function() {
            if (newPassword.value === confirmPassword.value) {
                confirmPassword.classList.remove('is-invalid');
                mismatchError.style.display = 'none';
            }
        });

        // Notificaciones de SweetAlert2 basadas en mensajes de sesión o errores del servidor
        @if (session('status') === 'password-updated')
        Swal.fire({
            icon: 'success',
            title: '¡Contraseña actualizada!',
            text: 'Tu clave de acceso ha sido modificada exitosamente.',
            timer: 3500,
            showConfirmButton: false,
            customClass: {
                popup: 'swal2-popup-hotel',
                title: 'swal2-title-hotel'
            }
        });
        @endif

        @if (session('status') === 'profile-updated')
        Swal.fire({
            icon: 'success',
            title: '¡Perfil actualizado!',
            text: 'Tus datos personales fueron guardados con éxito.',
            timer: 3500,
            showConfirmButton: false,
            customClass: {
                popup: 'swal2-popup-hotel',
                title: 'swal2-title-hotel'
            }
        });
        @endif

        @if ($errors->updatePassword->any())
        Swal.fire({
            icon: 'error',
            title: 'Error al actualizar',
            text: '{{ $errors->updatePassword->first() }}',
            customClass: {
                popup: 'swal2-popup-hotel',
                title: 'swal2-title-hotel',
                confirmButton: 'swal2-confirm-hotel'
            }
        });
        @endif
    });
</script>
</body>
</html>
