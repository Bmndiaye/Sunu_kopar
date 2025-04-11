<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class AuthController extends Controller
{
    public function create()
    {
        return view('pages.auth.auth');
    }

    public function auth(Request $request)
    {
        // Validation des champs
        $auth = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($auth)) {
            $request->session()->regenerate();
            $user = Auth::user();
            // dd($user);

            // Assigner un rôle si l'utilisateur n'en a pas encore
            if (!$user->hasAnyRole(['SUPER_ADMIN', 'GERANT', 'PARTICIPANT'])) {
                $user->assignRole('PARTICIPANT'); // Rôle par défaut
            }

            // Redirection en fonction du rôle
            if ($user->hasRole('SUPER_ADMIN')) {
                return redirect()->route('admin');
            } elseif ($user->hasRole('GERANT')) {
                return redirect()->route('admin');
            } elseif ($user->hasRole('PARTICIPANT')) {
                return redirect()->route('participant.dashboard'); // Modifie ici si nécessaire
            }

            return redirect()->route('home'); // Sécurité : redirection générique
        }

        return back()->with('error', "Email et/ou Mot de passe incorrect");
    }

    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
    public function navbar()
    {
        $user = Auth::user();
    
        if (!$user) {
            return redirect()->route('login')->with('error', 'Veuillez vous connecter.');
        }
    
       
    }
    


}
