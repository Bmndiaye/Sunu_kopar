<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Tirage;
use App\Models\Tontine;
use App\Models\Participant;
use Illuminate\Support\Facades\Mail;
use App\Mail\WinnerNotificationMail;  // Importation de la classe correcte WinnerNotificationMail

class TirageController extends Controller
{
    public function index()
    {
        // Récupérer les participants avec les informations utilisateur associées
        $participants = Participant::with('user')->get();

        // Récupérer l'historique des 10 derniers gagnants
        $gagnants = Tirage::with('user')->latest()->take(10)->get();

        // Récupérer le dernier gagnant
        $dernierGagnant = Tirage::with('user')->latest()->first();

        return view('tirage.index', compact('participants', 'gagnants', 'dernierGagnant'));
    }

    public function effectuerTirage($idTontine)
    {
        // Vérifier si la tontine existe
        $tontine = Tontine::findOrFail($idTontine);
    
        // Récupérer les participants éligibles
        $participants = User::whereDoesntHave('tirages', function ($query) use ($idTontine) {
            $query->where('idTontine', $idTontine);
        })->get();
    
        // Vérifier s'il reste des participants
        if ($participants->isEmpty()) {
            return response()->json(['message' => 'Tous les participants ont déjà été tirés.'], 400);
        }
    
        // Sélectionner un gagnant
        $winner = $participants->random();
    
        // Envoyer un e-mail de notification au gagnant
        $mail = new WinnerNotificationMail($winner, $tontine);

        \Mail::to($winner->email)->send($mail);    
        // Enregistrer le tirage en base
        Tirage::create([
            'idUser' => $winner->id,
            'idTontine' => $idTontine,
        ]);
    
        return response()->json([
            'message' => 'Tirage effectué avec succès.',
            'winner' => $winner->prenom . ' ' . $winner->nom,
        ]);
    }
}
