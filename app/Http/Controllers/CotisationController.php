<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cotisation;
use App\Models\Tontine;
use App\Models\User;

class CotisationController extends Controller
{
    public function create()
    {
        return view('gerant.cotisations');
    }

   
    public function getTontinesByTelephone(Request $request)
    {
        // Récupérer l'utilisateur par téléphone
        $user = User::where('telephone', $request->telephone)->first();
        
        if (!$user) {
            return response()->json([]);
        }
    
        // Requête pour récupérer les tontines
        $tontines = Tontine::join('participant_tontine', 'tontines.id', '=', 'participant_tontine.idTontine')
            ->where('participant_tontine.idUser', $user->id)
            ->select('tontines.id as tontine_id', 'tontines.libelle')
            ->get();
    
        // Retourner les données avec les informations de l'utilisateur
        return response()->json([
            'user' => [
                'id' => $user->id,
                'nom' => $user->nom,
                'prenom' => $user->prenom,
                'email' => $user->email,
            ],
            'tontines' => $tontines
        ]);
    }


    public function store(Request $request)
    {
        // Validation des données
        $request->validate([
            'idUser' => 'required|exists:users,id',
            'idTontine' => 'required|exists:tontines,id',
            'montant' => 'required|integer|min:1000',
            'moyen_paiement' => 'required|in:ESPECES,WAVE,OM',
        ]);

        // Vérifier si la cotisation existe déjà
        $existingCotisation = Cotisation::where('idUser', $request->idUser)
            ->where('idTontine', $request->idTontine)
            ->first();

        if ($existingCotisation) {
            return response()->json([
                'message' => 'Une cotisation pour cet utilisateur et cette tontine existe déjà.'
            ], 409);
        }

        // Création de la cotisation
        $cotisation = Cotisation::create([
            'idUser' => $request->idUser,
            'idTontine' => $request->idTontine,
            'montant' => $request->montant,
            'moyen_paiement' => $request->moyen_paiement,
        ]);

        return response()->json([
            'message' => 'Cotisation enregistrée avec succès.',
            'cotisation' => $cotisation
        ], 201);
    }
    
    
    

}
