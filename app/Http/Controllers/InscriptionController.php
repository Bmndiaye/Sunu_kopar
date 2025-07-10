<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\LoyaltyCardMail;
use Illuminate\Support\Facades\Mail;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

use Illuminate\Support\Facades\Validator;

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
            $participant->iduser = $user->id;
            $participant->dateNaissance = $request->dateNaissance;
            $participant->cni = $request->cni;
            $participant->adresse = $request->adresse;
            $participant->save();

            // $qrCode = QrCode::size(200)->generate($user->telephone);

            // Enregistrer le QR Code en tant qu'image temporaire
            // $qrCodePath = storage_path('app/public/qrcodes/user_' . $user->telephone . '.png');
            // \File::put($qrCodePath, $qrCode);

            // // Envoi de l'email avec le QR Code
            // Mail::to($user->email)->send(new LoyaltyCardMail($user, $qrCodePath));

            // // Supprimer le fichier temporaire après envoi
            // \File::delete($qrCodePath);

            // Authentification
            $request->session()->regenerate();

            // Redirection vers la page d'accueil
            // return redirect()->route('admin');

            return redirect()->route('login')->with('success', 'Inscription réussie ! Veuillez vous connecter.');
        }

        return back()->with('error', "Une erreur s'est produite");
    }

    public function home()
    {
        return view('welcome');
    }



    // Méthode pour afficher la modal (si besoin)
public function index2()
{
    // Cette méthode ne sera probablement pas utilisée directement car le formulaire est dans une modal
    return view('pages.inscription.modal');
}

// Méthode pour traiter l'inscription depuis la modal
public function register2(Request $request)
{
    try {
        $validator = Validator::make($request->all(), [
            'prenom' => 'required|min:3',
            'nom' => 'required|min:2',
            'email' => 'required|email|unique:users',
            'telephone' => 'required|max:9|unique:users',
            'dateNaissance' => 'required|date|before_or_equal:' . now()->subYears(18)->toDateString(),
            'cni' => 'required|min:13|max:13',
            'adresse' => 'required|string',
            'password' => 'required|min:6|confirmed'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

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
            $participant->iduser = $user->id;
            $participant->dateNaissance = $request->dateNaissance;
            $participant->cni = $request->cni;
            $participant->adresse = $request->adresse;
            $participant->save();

            return response()->json([
                'success' => true,
                'message' => 'Utilisateur ajouté avec succès!'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => "Une erreur s'est produite lors de la création de l'utilisateur"
        ], 500);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => $e->getMessage()
        ], 500);
    }
}
}
