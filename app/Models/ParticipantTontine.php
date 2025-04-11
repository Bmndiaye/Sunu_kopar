<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParticipantTontine extends Model
{
    use HasFactory;

    protected $table = 'participant_tontine';

    protected $fillable = ['iduser', 'idtontine'];

    /**
     * Relation avec l'utilisateur (participant)
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'iduser');
    }

    /**
     * Relation avec la tontine
     */
    public function tontine()
    {
        return $this->belongsTo(Tontine::class, 'idtontine');
    }
}
