<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

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
    use SoftDeletes;

    /**
     * Anonimiza los datos personales y aplica borrado suave (SoftDelete).
     */
    public function anonymizeAccount(): void
    {
        $this->update([
            'name' => 'Usuario Anonimizado #' . $this->id,
            'email' => 'deleted_' . $this->id . '_' . Str::random(8) . '@miproyecto.website',
            'password' => bcrypt(Str::random(32)),
        ]);

        $this->delete();
    }
}
