<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\LoyaltyCardMail;
use Illuminate\Support\Facades\Mail;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class InscriptionController extends Controller
{
    // Permet d'accéder à la vue inscription
    public function index()
    {
        return view('pages.inscription.index');
    }

    // Valider le formulaire
    public function register(Request $request)
    {
        $request->validate([
            'prenom' => 'required|min:3',
            'nom' => 'required|min:2',
            'email' => 'required|email|unique:users',
            'telephone' => 'required|max:9|unique:users',
            'dateNaissance' => 'required|date|before_or_equal:' . now()->subYears(18)->toDateString(),
            'cni' => 'required|min:13|max:13',
            'adresse' => 'required|string',
            'password' => 'required|min:6|confirmed'
        ]);

        // Enregistrement dans la base de données
        $user = User::create([
            'prenom' => $request->prenom,
            'nom' => $request->nom,
            'telephone' => $request->telephone,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // Enregistrement du participant si la création du User est bonne
        if ($user) {
            $participant = new Participant();
            $participant->idUser = $user->id;
            $participant->dateNaissance = $request->dateNaissance;
            $participant->cni = $request->cni;
            $participant->adresse = $request->adresse;
            $participant->save();

            // Générer le QR Code
            $qrCode = QrCode::size(200)->generate($user->id);

            // Enregistrer le QR Code en tant qu'image temporaire
            $qrCodePath = storage_path('app/public/qrcodes/user_' . $user->id . '.png');
            \File::put($qrCodePath, $qrCode);

            // Envoi de l'email avec le QR Code
            Mail::to($user->email)->send(new LoyaltyCardMail($user, $qrCodePath));

            // Supprimer le fichier temporaire après envoi
            \File::delete($qrCodePath);

            // Authentification
            $request->session()->regenerate();

            // Redirection vers la page d'accueil
            return redirect()->route('admin');
        }

        return back()->with('error', "Une erreur s'est produite");
    }

    public function home()
    {
        return view('welcome');
    }
}
