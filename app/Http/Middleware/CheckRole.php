<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAuthenticated
{
    public function handle(Request $request, Closure $next)
    {
        // Vérifie si l'utilisateur est authentifié
        if (!auth()->check()) {
            return redirect()->route('login'); // Redirige vers la page de connexion si non authentifié
        }

        return $next($request);
    }
}
