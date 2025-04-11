<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Participant extends Model
{
    protected $fillable = [
        'iduser',
        'dateNaissance',
        'cni',
        'adresse',
        'imageCni'
    ];

    use HasFactory;

    // Définir la relation avec le modèle User
    public function user()
    {
        return $this->belongsTo(User::class, 'iduser');
    }

    public function tontine()
    {
        return $this->belongsTo(Tontine::class, 'tontine_id');
    }
    


    
}




