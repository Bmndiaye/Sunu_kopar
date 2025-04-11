<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tirage extends Model
{
    use HasFactory;

    protected $fillable = ['iduser', 'idtontine'];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo // ✅ Ajout du namespace complet
    {
        return $this->belongsTo(User::class, 'iduser');
    }

    public function tontine(): \Illuminate\Database\Eloquent\Relations\BelongsTo // ✅ Ajout du namespace complet
    {
        return $this->belongsTo(Tontine::class, 'idtontine');
    }
}
