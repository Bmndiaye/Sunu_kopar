<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (!auth()->user() || !auth()->user()->hasRole($role)) {
            // Si l'utilisateur n'a pas le rôle requis, rediriger vers la page de connexion
            return redirect()->route('login');
        }

        return $next($request);
    }
}
