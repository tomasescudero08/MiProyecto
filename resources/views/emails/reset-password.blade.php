{{-- resources/views/emails/reset-password.blade.php --}}
@php
    $font = "'Montserrat', 'Helvetica Neue', Arial, sans-serif";
    $serif = "Georgia, 'Times New Roman', serif";

    // Parámetros imgix: recorte 1200x480, oscurecida y en JPG (compatible con todos los clientes de correo)
    $hero = !empty($heroImage)
        ? $heroImage . (str_contains($heroImage, '?') ? '&' : '?') . 'w=1200&h=480&fit=crop&crop=entropy&fm=jpg&q=80&auto=compress&bri=-25'
        : null;
@endphp
    <!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="color-scheme" content="dark light">
    <meta name="supported-color-schemes" content="dark light">
    <title>Restablece tu contraseña - HotelPro</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body { margin: 0; padding: 0; background-color: #121519; }
        a { color: #d4af37; }
        @media (max-width: 620px) {
            .container { width: 100% !important; }
            .px { padding-left: 24px !important; padding-right: 24px !important; }
            .hero, .hero-inner { height: 190px !important; }
        }
    </style>
</head>
<body style="margin:0;padding:0;background-color:#121519;">

{{-- Texto de vista previa (se ve en la bandeja de entrada, no dentro del correo) --}}
<div style="display:none;max-height:0;overflow:hidden;opacity:0;color:#121519;font-size:1px;line-height:1px;">
    Elige una nueva contraseña para tu cuenta. El enlace caduca en {{ $expire }} minutos.
</div>

<table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" bgcolor="#121519" style="background-color:#121519;">
    <tr>
        <td align="center" style="padding:32px 12px;">

            <table role="presentation" class="container" width="600" cellpadding="0" cellspacing="0" border="0" style="width:600px;max-width:600px;">

                {{-- Encabezado con imagen y logo --}}
                <tr>
                    <td class="hero" height="240" valign="middle" align="center" bgcolor="#171a1f"
                        @if($hero) background="{{ $hero }}" @endif
                        style="height:240px;background-color:#171a1f;@if($hero) background-image:url('{{ $hero }}');background-size:cover;background-position:center; @endif border:1px solid #504726;border-bottom:0;border-radius:8px 8px 0 0;">

                        <table role="presentation" width="100%" height="240" cellpadding="0" cellspacing="0" border="0">
                            <tr>
                                <td class="hero-inner" height="240" align="center" valign="middle"
                                    style="height:240px;background-color:rgba(18,21,25,0.55);border-radius:8px 8px 0 0;">

                                    <span style="font-family:{{ $serif }};font-size:38px;line-height:1.1;letter-spacing:1px;color:#ffffff;">Hotel<span style="color:#d4af37;">Pro</span></span>

                                    <table role="presentation" align="center" cellpadding="0" cellspacing="0" border="0" style="margin:16px auto 0;">
                                        <tr>
                                            <td width="56" height="2" bgcolor="#d4af37" style="width:56px;height:2px;font-size:0;line-height:0;">&nbsp;</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                {{-- Tarjeta de contenido --}}
                <tr>
                    <td class="px" bgcolor="#171a1f"
                        style="background-color:#171a1f;border:1px solid #504726;border-top:2px solid #d4af37;border-radius:0 0 8px 8px;padding:44px 48px 40px;font-family:{{ $font }};color:#e0e0e0;">

                        <h1 style="margin:0 0 18px;font-family:{{ $font }};font-size:26px;line-height:1.3;font-weight:600;color:#ffffff;">
                            Restablece tu contraseña
                        </h1>

                        <p style="margin:0;font-family:{{ $font }};font-size:15px;line-height:1.7;color:#d0d2d6;">
                            Recibimos una solicitud para cambiar la contraseña de tu cuenta en HotelPro.
                            Elige una nueva con el siguiente botón.
                        </p>

                        {{-- Botón --}}
                        <table role="presentation" cellpadding="0" cellspacing="0" border="0" style="margin:32px 0 28px;">
                            <tr>
                                <td bgcolor="#d4af37" style="background-color:#d4af37;border-radius:4px;">
                                    <a href="{{ $url }}" target="_blank"
                                       style="display:inline-block;padding:15px 36px;font-family:{{ $font }};font-size:14px;font-weight:600;letter-spacing:0.3px;color:#121519;text-decoration:none;border-radius:4px;">
                                        Cambiar contraseña
                                    </a>
                                </td>
                            </tr>
                        </table>

                        <p style="margin:0 0 28px;font-family:{{ $font }};font-size:14px;line-height:1.6;color:#b8bbc0;">
                            El enlace caduca en {{ $expire }} minutos.
                        </p>

                        <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0">
                            <tr>
                                <td height="1" bgcolor="#2a2f36" style="height:1px;font-size:0;line-height:0;background-color:#2a2f36;">&nbsp;</td>
                            </tr>
                        </table>

                        <p style="margin:24px 0 8px;font-family:{{ $font }};font-size:13px;line-height:1.6;color:#8d9298;">
                            Si el botón no funciona, copia este enlace en tu navegador:
                        </p>
                        <p style="margin:0 0 24px;font-family:{{ $font }};font-size:12px;line-height:1.6;word-break:break-all;">
                            <a href="{{ $url }}" target="_blank" style="color:#d4af37;text-decoration:underline;">{{ $url }}</a>
                        </p>

                        <p style="margin:0;font-family:{{ $font }};font-size:13px;line-height:1.6;color:#8d9298;">
                            Si no pediste este cambio, no hagas nada: tu contraseña seguirá igual.
                        </p>
                    </td>
                </tr>

                {{-- Pie --}}
                <tr>
                    <td align="center" style="padding:28px 12px 0;font-family:{{ $font }};font-size:12px;line-height:1.7;color:#6f757c;">
                        &copy; {{ date('Y') }} HotelPro<br>
                        <a href="{{ config('app.url') }}" target="_blank" style="color:#8d9298;text-decoration:none;">{{ preg_replace('#^https?://#', '', config('app.url')) }}</a>
                    </td>
                </tr>
            </table>

        </td>
    </tr>
</table>

</body>
</html>
