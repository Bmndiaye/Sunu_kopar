<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles; // Import du trait HasRoles
use Illuminate\Database\Eloquent\Relations\HasMany;


class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles; // Utilisation du trait HasRoles

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'prenom',
        'nom',
        'telephone',
        'email',
        'password',
        'profil'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function tontines()
    {
        return $this->belongsToMany(Tontine::class, 'participants', 'idUser', 'idTontine');
    }
    public function tirages(): HasMany
    {
        return $this->hasMany(Tirage::class, 'idUser');
    }

    public function user()
{
    return $this->belongsTo(User::class, 'idUser');
}

}
