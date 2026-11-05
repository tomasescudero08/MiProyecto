<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Confirmación de Reserva</title>
</head>
<body style="background-color: #121519; color: #fff; font-family: Arial, sans-serif; padding: 20px;">
<h2 style="color: #d4af37;">¡Hola, {{ $reservation->customer_name }}!</h2>
<p>Gracias por elegir <strong>HotelPro</strong>. Tu reserva ha sido registrada con éxito.</p>

<div style="background: #171a1f; padding: 15px; border-radius: 8px; margin: 20px 0; border: 1px solid rgba(255,255,255,0.08);">
    <p><strong>Habitación ID:</strong> {{ $reservation->room_id }}</p>
    <p><strong>Fecha de Check-in:</strong> {{ $reservation->check_in }}</p>
    <p><strong>Fecha de Check-out:</strong> {{ $reservation->check_out }}</p>
    <p><strong>Total a pagar:</strong> ${{ number_format($reservation->total_price, 0) }}</p>
</div>

<p>Te esperamos para brindarte una estancia inolvidable.</p>
</body>
</html>
