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
        $participants = Participant::with('user')->get();

        $gagnants = Tirage::with('user')->latest()->take(10)->get();

        $dernierGagnant = Tirage::with('user')->latest()->first();

        return view('tirage.index', compact('participants', 'gagnants', 'dernierGagnant'));
    }

    public function effectuerTirage($idtontine)
    {
        // Vérifier si la tontine existe
        $tontine = Tontine::findOrFail($idtontine);
    
        // Récupérer les participants éligibles qui n'ont pas encore été tirés
        $participants = User::whereHas('tontines', function ($query) use ($idtontine) {
            $query->where('tontines.id', $idtontine);
        })->whereDoesntHave('tirages', function ($query) use ($idtontine) {
            $query->where('idtontine', $idtontine);
        })->get();
    
        // Vérifier s'il reste des participants
        if ($participants->isEmpty()) {
            return response()->json(['message' => 'Tous les participants ont déjà été tirés.'], 400);
        }
    
        // Sélectionner un gagnant aléatoire
        $winner = $participants->random();
    
        // Envoyer un e-mail de notification au gagnant
        $mail = new WinnerNotificationMail($winner, $tontine);
        \Mail::to($winner->email)->send($mail);    
    
        // Enregistrer le tirage en base
        Tirage::create([
            'iduser' => $winner->id,
            'idtontine' => $idtontine,
        ]);
    
        return response()->json([
            'message' => 'Tirage effectué avec succès.',
            'winner' => $winner->prenom . ' ' . $winner->nom,
        ]);
    }
    
}
