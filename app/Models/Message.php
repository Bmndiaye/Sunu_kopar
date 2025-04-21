<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['user_id', 'tontine_id', 'contenu'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function tontine() {
        return $this->belongsTo(Tontine::class);
    }
}
