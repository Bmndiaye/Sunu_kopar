<?php

namespace App\Models;

trait HasFactory
{
    /**
     * Génère un modèle pour une usine.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public static function factory()
    {
        return \Illuminate\Database\Eloquent\Factories\Factory::new();
    }
}
