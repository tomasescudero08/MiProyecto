<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Mail;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function sendPasswordResetNotification($token)
    {
        \Log::info('Reset llamado para: ' . $this->email);

        $url = url(route('password.reset', [
            'token' => $token,
            'email' => $this->getEmailForPasswordReset(),
        ], false));

        $html = '
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <style>
            body { background-color: #121519; color: #e0e0e0; font-family: Arial, sans-serif; margin: 0; padding: 40px 10px; }
            .email-container { max-width: 480px; margin: 0 auto; background-color: #171a1f; border: 1px solid rgba(212, 175, 55, 0.3); border-radius: 8px; padding: 40px; }
            .brand { text-align: center; font-size: 28px; font-weight: bold; color: #ffffff; text-decoration: none; margin-bottom: 25px; display: block; }
            .brand span { color: #d4af37; }
            h2 { color: #ffffff; font-size: 20px; text-align: center; margin-top: 0; }
            p { color: #b0b0b0; font-size: 14px; line-height: 1.6; text-align: center; margin-bottom: 30px; }
            .btn-gold { display: block; width: 100%; box-sizing: border-box; background-color: #d4af37; color: #121519; text-align: center; padding: 14px 0; border-radius: 6px; font-weight: bold; text-decoration: none; font-size: 15px; margin-bottom: 25px; }
            .footer { text-align: center; font-size: 12px; color: #757575; border-top: 1px solid rgba(255,255,255,0.1); padding-top: 20px; margin-top: 30px; }
        </style>
    </head>
    <body>
        <div class="email-container">
            <a href="' . config('app.url') . '" class="brand">Hotel<span>Pro</span></a>
            <h2>Solicitud de Recuperación</h2>
            <p>Has recibido este correo porque solicitaste restablecer la contraseña de tu cuenta en HotelPro.</p>
            <a href="' . $url . '" class="btn-gold">Restablecer Contraseña</a>
            <p style="font-size: 12px; color: #888; text-align: left;">Si el botón no funciona, ingresa mediante el siguiente enlace:<br><span style="color: #d4af37; word-break: break-all;">' . $url . '</span></p>
            <div class="footer">&copy; ' . date('Y') . ' HotelPro. Todos los derechos reservados.</div>
        </div>
    </body>
    </html>';

        Mail::html($html, function ($message) {
            $message->to($this->email)
                ->subject('Restablecer contraseña - HotelPro');
        });
    }
}
