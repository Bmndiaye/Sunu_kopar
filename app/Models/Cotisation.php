<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cotisation extends Model
{
    protected $fillable = [
        'iduser',
        'idtontine',
        'montant',
        'moyen_paiement',
        'created_at'
    ];
}
