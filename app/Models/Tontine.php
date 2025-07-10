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
            return $this->belongsToMany(User::class, 'participant_tontine', 'idtontine', 'iduser');
        }
        

        public function ParticipantTontine()
    {
        return $this->hasMany(ParticipantTontine::class, 'idtontine');
    }



    // Relation avec le créateur
    public function creator()
    {
        return $this->belongsTo(User::class, 'idCreateur');
    }



    
}
