<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Cotisation;
use App\Models\Tontine;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use App\Mail\FactureNotificationMail;
use Illuminate\Support\Facades\Mail;

class CotisationController extends Controller
{
    public function create()
    {
        return view('participant.cotisation');
    }

    public function getTontinesByTelephone(Request $request)
    {
        $user = User::where('telephone', $request->telephone)->first();

        if (!$user) {
            return response()->json([]);
        }

        $tontines = Tontine::join('participant_tontine', 'tontines.id', '=', 'participant_tontine.idtontine')
            ->where('participant_tontine.iduser', $user->id)
            ->select('tontines.id as tontine_id', 'tontines.libelle')
            ->get();

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
    
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        Log::info('Requête brute reçue', ['raw' => $request->getContent()]);
        $data = json_decode($request->getContent(), true);
        
        if (!is_array($data)) {
            Log::error('Format JSON invalide.');
            return response()->json(['message' => 'Format JSON invalide.'], 400);
        }
        
        Log::info('Données reçues', ['data' => $data]);
        
        if (isset($data['body'])) {
            $data = json_decode($data['body'], true);
        }
        
        if (isset($data['montant']) && is_numeric($data['montant'])) {
            $data['montant'] = (int) $data['montant'];
            Log::info('Montant converti en integer', ['montant' => $data['montant']]);
        } else {
            Log::error('Le montant est manquant ou invalide.', ['data' => $data]);
            return response()->json(['message' => 'Le montant est invalide.'], 400);
        }
        
        try {
            $validatedData = validator($data, [
                'iduser' => 'required|exists:users,id',
                'idtontine' => 'required|exists:tontines,id',
                'montant' => 'required|integer|min:1',
                'moyen_paiement' => 'required|string',
                'created_at' => 'required|date_format:Y-m-d'
            ])->validate();
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Erreur de validation', ['errors' => $e->errors()]);
            return response()->json(['message' => 'Données invalides', 'errors' => $e->errors()], 422);
        }
        
        // 🔥 Suppression de la vérification d'existence 🔥
        $cotisation = Cotisation::create($validatedData);
        Log::info('Cotisation enregistrée avec succès', ['cotisation' => $cotisation]);
        
        // Récupérer la tontine associée à la cotisation
        $tontine = Tontine::findOrFail($validatedData['idtontine']);
        
        // Récupérer l'utilisateur qui a fait la cotisation
        $user = User::findOrFail($validatedData['iduser']);
        
        // Envoyer un e-mail de notification de facture
        try {
            \Mail::to($user->email)->send(new FactureNotificationMail($cotisation, $tontine));
            $user->notify(new \App\Notifications\FactureNotificationSms($cotisation, $tontine));
        } catch (\Exception $e) {
            Log::warning('Erreur lors de l\'envoi des notifications.', ['exception' => $e->getMessage()]);
        }
        
        
        return response()->json([
            'message' => 'Cotisation enregistrée avec succès.',
            'cotisation' => $cotisation
        ], 201);
    }
    
    
    
    public function afficherCalendrier()
    {
        $user_id = Auth::id();
        if (!$user_id) {
            return redirect()->route('login');
        }
    
        $user = User::findOrFail($user_id);
    
        $tontines = Tontine::join('participant_tontine', 'tontines.id', '=', 'participant_tontine.idtontine')
            ->where('participant_tontine.iduser', $user_id)
            ->select('tontines.*')
            ->get();
    
        $calendriers = [];
    
        foreach ($tontines as $tontine) {
            $datesACotiser = $this->genererDatesACotiser($tontine);
    
            $participants = User::join('participant_tontine', 'users.id', '=', 'participant_tontine.iduser')
                ->where('participant_tontine.idtontine', $tontine->id)
                ->select('users.id', 'users.nom', 'users.prenom', 'participant_tontine.ordre')
                ->orderBy('participant_tontine.ordre')
                ->get();
    
            // Vérifier les cotisations pour chaque date
            foreach ($datesACotiser as &$date) {
                $dateCotisation = Carbon::createFromFormat('d/m/Y', $date['date']);
    
                $dejaCotise = Cotisation::where('idtontine', $tontine->id)
                    ->where('iduser', $user_id)
                    ->whereDate('created_at', $dateCotisation->format('Y-m-d'))
                    ->exists();
    
                $date['dejaCotise'] = $dejaCotise;
            }
    
            $calendriers[$tontine->id] = [
                'tontine' => $tontine,
                'participants' => $participants,
                'datesACotiser' => $datesACotiser,
            ];
        }
    
        return view('admin.user-list', compact('user', 'calendriers'));
    }
    
    private function genererDatesACotiser($tontine)
    {
        $datesACotiser = [];
        $datedebut = Carbon::parse($tontine->datedebut);
        
        // Compter le nombre de participants dans cette tontine
        $nombreParticipants = DB::table('participant_tontine')
            ->where('idtontine', $tontine->id)
            ->count();
        
        $nextDate = $datedebut->copy(); // Commencer à la date de début
        $user_id = Auth::id(); // Récupérer l'ID de l'utilisateur connecté
    
        // Générer exactement le nombre d'échéances = nombre de participants
        for ($tour = 1; $tour <= $nombreParticipants; $tour++) {
            // Vérifier si une cotisation a été faite pour cette date
            $dejaCotise = Cotisation::where('idtontine', $tontine->id)
                ->where('iduser', $user_id)
                ->whereDate('created_at', $nextDate->format('Y-m-d'))
                ->exists();
    
            // Récupérer le bénéficiaire de ce tour
            $beneficiaire = DB::table('participant_tontine')
                ->join('users', 'users.id', '=', 'participant_tontine.iduser')
                ->where('participant_tontine.idtontine', $tontine->id)
                ->where('participant_tontine.ordre', $tour)
                ->select('users.nom', 'users.prenom')
                ->first();
    
            $datesACotiser[] = [
                'tour' => $tour,
                'date' => $nextDate->format('d/m/Y'),
                'dejaCotise' => $dejaCotise,
                'beneficiaire' => $beneficiaire ? $beneficiaire->nom . ' ' . $beneficiaire->prenom : 'Non défini',
                'montant_a_cotiser' => $tontine->montant_de_base,
                'montant_total_tour' => $tontine->montant_de_base * $nombreParticipants,
            ];
    
            // Ajouter l'intervalle correspondant à la fréquence pour la prochaine échéance
            if ($tour < $nombreParticipants) { // Éviter d'ajouter après le dernier tour
                switch ($tontine->frequence) {
                    case 'JOURNALIERE':
                        $nextDate->addDay();
                        break;
                    case 'HEBDOMADAIRE':
                        $nextDate->addWeek();
                        break;
                    case 'MENSUEL':
                        $nextDate->addMonth();
                        break;
                    case 'TRIMESTRIEL':
                        $nextDate->addMonths(3);
                        break;
                }
            }
        }
    
        return $datesACotiser;
    }
    

    private function calculerDatesVersements($tontine)
    {
        $participants = User::join('participant_tontine', 'users.id', '=', 'participant_tontine.iduser')
            ->where('participant_tontine.idtontine', $tontine->id)
            ->select('users.id', 'participant_tontine.ordre')
            ->orderBy('participant_tontine.ordre')
            ->get();

        $datedebut = Carbon::parse($tontine->datedebut);
        $frequence = [
            'JOURNALIERE' => 'addDays',
            'HEBDOMADAIRE' => 'addWeeks',
            'MENSUEL' => 'addMonths',
            'TRIMESTRIEL' => 'addMonths'
        ];

        $methode = $frequence[$tontine->frequence] ?? 'addMonths';
        $valeur = 1;

        if ($tontine->frequence == 'HEBDOMADAIRE') {
            $valeur = 1;
        } elseif ($tontine->frequence == 'TRIMESTRIEL') {
            $valeur = 3;
        }

        foreach ($participants as $participant) {
            $datePrevue = $datedebut->copy();

            if ($tontine->frequence == 'JOURNALIERE' || $tontine->frequence == 'HEBDOMADAIRE') {
                $intervalJours = $tontine->frequence == 'JOURNALIERE' ? 1 : 7;
                $datePrevue->addDays(($participant->ordre - 1) * $intervalJours);
            } else {
                $datePrevue->$methode(($participant->ordre - 1) * $valeur);
            }

            DB::table('participant_tontine')
                ->where('idtontine', $tontine->id)
                ->where('iduser', $participant->id)
                ->update(['date_prevue' => $datePrevue->format('Y-m-d')]);
        }
    }


    public function getEcheances(Request $request, $tontineId, $userId)
    {
        // Vérifier si l'utilisateur existe
        $user = User::find($userId);
        if (!$user) {
            return response()->json(['message' => 'Utilisateur non trouvé'], 404);
        }
        
        // Vérifier si la tontine existe
        $tontine = Tontine::find($tontineId);
        if (!$tontine) {
            return response()->json(['message' => 'Tontine non trouvée'], 404);
        }
        
        // Générer toutes les dates à cotiser
        $datesACotiser = $this->genererDatesACotiser($tontine);
        
        // Récupérer les cotisations existantes pour cet utilisateur et cette tontine
        $cotisations = Cotisation::where('iduser', $userId)
                                 ->where('idtontine', $tontineId)
                                 ->get()
                                 ->keyBy(function($cotisation) {
                                     // Transformer la date en format jour/mois/année pour la comparaison
                                     return date('d/m/Y', strtotime($cotisation->created_at));
                                 });
        
        // Marquer les dates déjà cotisées
        foreach ($datesACotiser as &$date) {
            $date['dejaCotise'] = isset($cotisations[$date['date']]);
        }
        
        // Filtrer selon le statut si demandé
        $statut = $request->query('statut', 'toutes');
        if ($statut === 'non_payees') {
            $datesACotiser = array_filter($datesACotiser, function($date) {
                return !$date['dejaCotise'];
            });
        }
        
        return response()->json([
            'dates' => array_values($datesACotiser), // array_values pour renuméroter
            'montant_de_base' => $tontine->montant_de_base,
            'frequence' => $tontine->frequence,
        ]);
    }

    
}
