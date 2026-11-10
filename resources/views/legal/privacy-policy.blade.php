<!doctype html>
<html lang="es" data-bs-theme="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HotelPro - Política de Tratamiento de Datos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <style>
        body { background-color: #121519; color: #e0e0e0; font-family: 'Montserrat', sans-serif; }
        .legal-card { background-color: #171a1f; border: 1px solid rgba(212, 175, 55, 0.3); border-radius: 8px; box-shadow: 0 15px 35px rgba(0,0,0,0.6); }
        h1, h2, h3 { color: #fff; }
        .text-gold { color: #d4af37 !important; }
    </style>
</head>
<body class="py-5">

<div class="container" style="max-width: 800px;">
    <div class="text-center mb-4">
        <a class="brand-hotel text-decoration-none fs-2" href="{{ route('home') }}">
            Hotel<span>Pro</span>
        </a>
        <h1 class="fw-bold mt-3 fs-3">Política de Tratamiento de Datos Personales</h1>
        <p class="text-white small opacity-75">En cumplimiento de la Ley 1581 de 2012 y el Decreto 1377 de 2013</p>
    </div>

    <div class="legal-card p-4 p-md-5 mb-4">
        <h2 class="fs-5 text-gold mb-3">1. Identificación del Responsable del Tratamiento</h2>
        <p class="small opacity-75"><strong>HotelPro S.A.S.</strong>, ubicado en Colombia, es el responsable del tratamiento de los datos personales recopilados a través de esta plataforma. Canales de atención para el ejercicio de derechos: correo electrónico <span class="text-gold">privacidad@miproyecto.website</span>.</p>

        <h2 class="fs-5 text-gold mt-4 mb-3">2. Finalidad del Tratamiento de los Datos</h2>
        <p class="small opacity-75">Los datos personales recolectados (nombres, correos electrónicos, teléfonos y registros de reservas) serán utilizados única y exclusivamente para:</p>
        <ul class="small opacity-75">
            <li>Gestionar el registro, autenticación y acceso a la plataforma HotelPro.</li>
            <li>Procesar, confirmar y administrar reservas de alojamiento.</li>
            <li>Enviar notificaciones transaccionales (recuperación de contraseña, confirmaciones de reserva).</li>
            <li>Cumplir con obligaciones legales y contractuales aplicables al sector hotelero en Colombia.</li>
        </ul>

        <h2 class="fs-5 text-gold mt-4 mb-3">3. Autorización del Titular</h2>
        <p class="small opacity-75">Al registrarse o utilizar los servicios de HotelPro, el usuario manifiesta de forma previa, expresa e informada su autorización para que sus datos sean tratados conforme a los términos de esta política, de acuerdo con el artículo 9 de la Ley 1581 de 2012.</p>

        <h2 class="fs-5 text-gold mt-4 mb-3">4. Derechos del Titular</h2>
        <p class="small opacity-75">Como titular de los datos, usted tiene derecho a:</p>
        <ul class="small opacity-75">
            <li>Conocer, actualizar y rectificar sus datos personales.</li>
            <li>Solicitar prueba de la autorización otorgada.</li>
            <li>Ser informado sobre el uso que se le ha dado a sus datos.</li>
            <li>Revocar la autorización y/o solicitar la supresión del dato cuando no se respeten los principios constitucionales y legales.</li>
        </ul>

        <h2 class="fs-5 text-gold mt-4 mb-3">5. Medidas de Seguridad</h2>
        <p class="small opacity-75">HotelPro adopta las medidas técnicas, humanas y administrativas razonables necesarias para otorgar seguridad a los registros, evitando su adulteración, pérdida, consulta, uso o acceso no autorizado o fraudulento (incluyendo cifrado de contraseñas y control de rutas protegidas por roles).</p>
    </div>

    <div class="text-center">
        <a href="{{ url()->previous() }}" class="text-white small text-decoration-none opacity-75"><i class="bi bi-arrow-left me-1"></i> Volver atrás</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
