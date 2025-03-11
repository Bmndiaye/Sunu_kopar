<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tontine extends Model
{
    use HasFactory;

    protected $fillable = [
        'frequence',
        'libelle',
        'dateDebut',
        'dateFin',
        'description',
        'montant_total',
        'montant_de_base',
        'nbreParticipant'
    ];

    /**
     * Relation avec les participants (utilisateurs)
     */
   
        public function participants()
        {
            return $this->belongsToMany(User::class, 'participants', 'idTontine', 'idUser');
        }
    

        public function ParticipantTontine()
    {
        return $this->hasMany(ParticipantTontine::class, 'idTontine');
    }
    
}
