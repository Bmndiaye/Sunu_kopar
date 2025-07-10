<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Tirage;
use App\Models\Tontine;
use App\Models\Participant;
use Illuminate\Support\Facades\Mail;
use App\Mail\WinnerNotificationMail;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;  // Assure-toi que cette ligne est ajoutée

class TirageController extends Controller
{
    public function index()
    {
        // Get all active tontines for the dropdown
        $tontines = Tontine::where('etat', 'en_attend')->get();
    
        // Get participants with user and tontine
        $participants = Participant::with('user', 'tontine')
        ->whereHas('user') // s'assure que le user existe
        ->get();
       
    
        // Get recent winners for history display
        $gagnants = Tirage::with(['user:id,prenom,nom,email', 'tontine:id,libelle'])
        ->latest()
        ->take(10)
        ->get();
    

    
    
        // Get the most recent winner
        $dernierGagnant = Tirage::select('id', 'user_id', 'tontine_id', 'created_at')
            ->with('user', 'tontine')
            ->orderBy('created_at', 'desc')
            ->first();
    
        return view('tirage.index', compact('participants', 'gagnants', 'dernierGagnant', 'tontines'));
    }
    
    
    
    public function effectuerTirage($idtontine)
    {
        try {
            // Verify tontine exists
            $tontine = Tontine::findOrFail($idtontine);
            
        

            $participants = User::whereHas('tontines', function ($query) use ($idtontine) {
                $query->where('idtontine', $idtontine);
            })->whereDoesntHave('tirages', function ($query) use ($idtontine) {
                $query->where('idtontine', $idtontine);
            })->get();
            
            
            
            // Check if there are any participants left
            if ($participants->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Tous les participants ont déjà été tirés pour cette tontine.'
                ], 400);
            }
            
            // Select a random winner
            $winner = $participants->random();
            
            // Record the draw in the database
            Tirage::create([
                'iduser' => $winner->id,
                'idtontine' => $idtontine,
            ]);
            
            // Send notification email
            try {
                $mail = new WinnerNotificationMail($winner, $tontine);
                Mail::to($winner->email)->send($mail);
            } catch (Exception $e) {
                // Log email failure but don't stop the process
                Log::error('Failed to send winner notification email: ' . $e->getMessage());
            }
            
            return response()->json([
                'success' => true,
                'message' => 'Tirage effectué avec succès.',
                'winner' => $winner->prenom . ' ' . $winner->nom,
                'tontine' => $tontine->libelle
            ]);
            
        } catch (Exception $e) {
            Log::error('Draw error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue lors du tirage: ' . $e->getMessage()
            ], 500);
        }
    }
}



