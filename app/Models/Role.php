<?php

namespace App\Models;

use Spatie\Permission\Models\Role as SpatieRole;
use Spatie\Permission\Models\Permission;

class Role extends SpatieRole
{
    // Exemple d'ajout d'une méthode personnalisée
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    // Autres méthodes ou relations personnalisées
}
