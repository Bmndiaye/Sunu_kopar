<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles; // Import du trait HasRoles
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Participant;


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
        return $this->belongsToMany(Tontine::class, 'participant_tontine', 'iduser', 'idtontine');
    }
    
    
    public function tirages(): HasMany
    {
        return $this->hasMany(Tirage::class, 'iduser');
    }

    public function user()
{
    return $this->belongsTo(User::class, 'iduser');
}


public function participations()
{
    return $this->hasMany(Participant::class, 'iduser');
}
public function aDejaParticipe($tontineId)
{
    return $this->tontines()->wherePivot('idtontine', $tontineId)->exists();
}



}
