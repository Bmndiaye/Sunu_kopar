<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Tontine;
use App\Models\ParticipantTontine;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Cotisation;

class TontineController extends Controller
{
    // Liste des tontines avec filtres et recherche
    public function index(Request $request)
    {
        // Initialiser la requête pour récupérer les tontines
        $query = Tontine::with('creator', 'participants');
        
        // Appliquer les filtres si présents
        
        // Filtre de recherche par libellé
        if ($request->has('search') && !empty($request->search)) {
            $query->where('libelle', 'LIKE', '%' . $request->search . '%');
        }
        
        // Filtre par état
        if ($request->has('etat') && !empty($request->etat)) {
            $query->where('etat', $request->etat);
        }
        
        // Filtre par créateur
        if ($request->has('creator') && !empty($request->creator)) {
            $query->where('idCreateur', $request->creator);
        }
        
        // Récupérer les tontines filtrées
        $tontines = $query->get();
        
        // Vérifier si l'utilisateur actuel participe à chaque tontine
        $userId = Auth::id();
        foreach ($tontines as $tontine) {
            $tontine->isParticipant = $tontine->participants->contains('iduser', $userId);
        }
        
        return view('admin.tontine-list', compact('tontines'));
    }

    // Le reste du contrôleur reste inchangé
    public function show($id)
    {
        // Récupérer la tontine avec ses participants et leurs détails utilisateur
        $tontine = Tontine::with(['participants.user', 'creator'])->findOrFail($id);
        $userId = Auth::id();
        
        // Vérifier si l'utilisateur participe
        $isParticipant = $tontine->participants->contains('iduser', $userId);
        
        // Récupérer les détails de cotisation pour chaque participant
        foreach ($tontine->participants as $participant) {
            // Récupérer les cotisations pour ce participant dans cette tontine
            $cotisations = \App\Models\Cotisation::where('idtontine', $id)
                ->where('iduser', $participant->user->id)
                ->orderBy('created_at', 'desc')
                ->get();
            
            // Calculer le montant total payé
            $totalPaid = $cotisations->sum('montant');
            
            // Ajouter ces détails à l'objet participant
            $participant->cotisations = $cotisations;
            $participant->totalPaid = $totalPaid;
            
            // Calculer si les paiements sont à jour
            $today = \Carbon\Carbon::now();
            $dateDebut = \Carbon\Carbon::parse($tontine->dateDebut);
            $frequence = [
                'JOURNALIERE' => 1, // En jours
                'HEBDOMADAIRE' => 7, // En jours
                'MENSUEL' => 1, // En mois
                'TRIMESTRIEL' => 3 // En mois
            ];
            
            // Calculer combien de paiements auraient dû être effectués
            $expectedPayments = 0;
            $nextDate = $dateDebut->copy();
            
            while ($nextDate->lte($today)) {
                $expectedPayments++;
                
                // Ajouter l'intervalle selon la fréquence
                $nextDate = match ($tontine->frequence) {
                    'JOURNALIERE', 'HEBDOMADAIRE' => $nextDate->addDays($frequence[$tontine->frequence]),
                    'MENSUEL', 'TRIMESTRIEL' => $nextDate->addMonths($frequence[$tontine->frequence]),
                    default => $nextDate->addMonths(1)
                };
            }
            
            // Comparer avec les paiements réels
            $actualPayments = $cotisations->count();
            $participant->paymentStatus = $actualPayments >= $expectedPayments ? 'À jour' : 'En retard';
            $participant->paymentsMissing = max(0, $expectedPayments - $actualPayments);
        }
        
        // Calculer le montant total collecté pour cette tontine
        $totalCollected = \App\Models\Cotisation::where('idtontine', $id)->sum('montant');
        
        // Calculer le prochain bénéficiaire
        $nextBeneficiary = null;
        $today = \Carbon\Carbon::now();
        
        foreach ($tontine->participants as $participant) {
            $datePrevue = isset($participant->date_prevue) ? \Carbon\Carbon::parse($participant->date_prevue) : null;
            if ($datePrevue && $datePrevue->gt($today) && (!$nextBeneficiary || $datePrevue->lt(\Carbon\Carbon::parse($nextBeneficiary->date_prevue)))) {
                $nextBeneficiary = $participant;
            }
        }
        
        return view('admin.tontine-detail', compact('tontine', 'isParticipant', 'totalCollected', 'nextBeneficiary'));
    }

    public function participer(Request $request, $id)
    {
        $userId = Auth::id();
        $tontine = Tontine::findOrFail($id);
    
        // Étape 1 : Vérifier si l'utilisateur participe déjà
        $existe = ParticipantTontine::where('iduser', $userId)
                                    ->where('idtontine', $id)
                                    ->exists();
        if ($existe) {
            return redirect()->back()
                ->with('error', 'Vous participez déjà à cette tontine.')
                ->with('etape', 'verification_participation');
        }
    
        // Étape 2 : Compter le nombre actuel de participants
        $participantCount = ParticipantTontine::where('idtontine', $id)->count();
        
        // Calculer les places restantes
        $placesRestantes = $tontine->nbreparticipant - $participantCount;
        
        // Étape 3 : Vérifier s'il reste des places
        if ($placesRestantes <= 0) {
            return redirect()->back()
                ->with('error', 'Désolé, il n\'y a plus de places disponibles.')
                ->with('etape', 'verification_places');
        }
    
        // Étape 4 : Enregistrement de la participation
        $participation = ParticipantTontine::create([
            'iduser' => $userId,
            'idtontine' => $id,
        ]);
    
        // Étape 5 : Calculer le nouveau nombre de participants
        $nouveauNombreParticipants = $participantCount + 1;
        
        // Étape 6 : Vérifier si le nombre de participants est atteint
        $etatModifie = false;
        if ($nouveauNombreParticipants >= $tontine->nbreparticipant) {
            // Mettre à jour l'état de la tontine
            $tontine->etat = 'en_cours';
            $tontine->save();
            $etatModifie = true;
        }
    
        // Étape 7 : Retour avec tous les détails
        return redirect()->back()
            ->with('success', 'Participation confirmée avec succès.')
            ->with('etape', 'participation_reussie')
            ->with('details', [
                'participant_id' => $participation->id,
                'nombre_participants_avant' => $participantCount,
                'nombre_participants_apres' => $nouveauNombreParticipants,
                'places_restantes' => max(0, $tontine->nbreparticipant - $nouveauNombreParticipants),
                'etat_modifie' => $etatModifie,
                'nouveau_etat' => $tontine->etat
            ]);
    }
    public function aDejaParticipe($tontineId)
    {
        return $this->tontines()->where('tontine_id', $tontineId)->exists();
    }

    public function quitter($id)
    {
        $userId = Auth::id();
        // Vérifier si l'utilisateur participe bien
        $participation = ParticipantTontine::where('iduser', $userId)->where('idtontine', $id)->first();
        if (!$participation) {
            return redirect()->back()->with('error', 'Vous ne participez pas à cette tontine.');
        }
        // Suppression de la participation
        $participation->delete();
        return redirect()->back()->with('success', 'Vous avez quitté la tontine.');
    }

    public function supprimerTontine($id)
    {
        $tontine = Tontine::findOrFail($id);
        $tontine->delete();
        return redirect()->back()->with('success', 'Tontine supprimée avec succès.');
    }
   
    public function detailsTontine($id)
    {
        $tontine = Tontine::with(['participants.user', 'creator'])->findOrFail($id);
        $userId = Auth::id();
        
        // Vérifier si l'utilisateur connecté est un participant
        $isParticipant = $tontine->participants->contains('iduser', $userId);
    
        // Charger toutes les cotisations en une seule requête pour éviter le N+1
        $cotisations = \App\Models\Cotisation::where('idtontine', $id)->get();
    
        // Vérifier les données des cotisations (décommente si besoin)
        // dd($cotisations->toArray());
    
        // Associer les cotisations et calculer le total payé pour chaque participant
        foreach ($tontine->participants as $participant) {
            // Filtrer les cotisations de ce participant
            $participantCotisations = $cotisations->where('iduser', $participant->iduser);
    
            // Calculer le montant total payé
            $totalPaid = $participantCotisations->sum(fn($c) => floatval($c->montant ?? 0));
    
            // Ajouter ces détails à l'objet participant
            $participant->cotisations = $participantCotisations;
            $participant->totalPaid = $totalPaid;
    
            // Déterminer le statut de paiement (À jour / En retard)
            $participant->paymentStatus = $totalPaid >= ($tontine->montant * $this->getExpectedPaymentCount($tontine, $participant)) 
                ? 'À jour' 
                : 'En retard';
        }
    
        // Calculer le montant total collecté
        $totalCollected = $cotisations->sum(fn($c) => floatval($c->montant ?? 0));
    
        // Déterminer le prochain bénéficiaire
        $nextBeneficiary = $tontine->participants
            ->where('date_prevue', '>=', now())
            ->sortBy('date_prevue')
            ->first();
    
        return view('tontines.details', compact('tontine', 'isParticipant', 'totalCollected', 'nextBeneficiary'));
    }
    
    /**
     * Calcule le nombre de paiements attendus pour un participant
     */
    private function getExpectedPaymentCount($tontine, $participant)
    {
        // Cette méthode devrait être implémentée selon votre logique métier
        // Par exemple, selon la fréquence de la tontine et la date actuelle
        
        $startDate = new \DateTime($tontine->dateDebut);
        $now = new \DateTime();
        
        switch($tontine->frequence) {
            case 'Hebdomadaire':
                $weeks = ceil($startDate->diff($now)->days / 7);
                return max(1, $weeks);
            case 'Mensuelle':
                $months = $startDate->diff($now)->m + ($startDate->diff($now)->y * 12);
                return max(1, $months);
            case 'Quotidienne':
                return max(1, $startDate->diff($now)->days);
            default:
                return 1;
        }
    }
    
    /**
     * Récupère les paiements d'un participant
     */
    public function getPaiements($participantId)
    {
        // Vérifier que l'utilisateur a le droit de voir ces informations
        // (vous pourriez ajouter une vérification d'autorisation ici)
        
        $paiements = \App\Models\Cotisation::where('iduser', $participantId)
            ->orderBy('created_at', 'desc')
            ->get(['created_at as date', 'montant', 'moyen_paiement']);

        
        return response()->json($paiements);
    }


     


}