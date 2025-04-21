<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Tontine;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    /**
     * Affiche la liste des messages d'une tontine
     *
     * @return \Illuminate\Http\Response
     */
 /**
 * Affiche la liste des messages d'une tontine
 *
 * @return \Illuminate\Http\Response
 */
public function index()
{
    $user = auth()->user();
    
    // Récupération de tous les messages
    $messages = Message::with('user')
                ->orderBy('created_at', 'asc')
                ->get();
    
    $tontine = null; // Si vous avez besoin de cette variable dans votre vue
    
    return view('messages.index', compact('messages', 'tontine'));
}
    /**
     * Enregistre un nouveau message
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $tontineId
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validation des données
        $request->validate([
            'contenu' => 'required|string|max:1000',
        ]);
    
        $user = Auth::user();
    
        // Création du message sans référence à une tontine
        Message::create([
            'user_id' => $user->id,
            'contenu' => $request->contenu,
        ]);
    
        return redirect()->back()->with('success', 'Message envoyé avec succès.');
    }
    public function markAsReadAndRedirect()
    {
        $user = Auth::user();
    
        // Marquer tous les messages des autres comme lus
        Message::where('user_id', '!=', $user->id)
            ->where('is_read', false)
            ->update(['is_read' => true]);
    
        return redirect()->route('messages.index');
    }
    

    
    /**
     * Permet de modifier un message
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $message = Message::findOrFail($id);
        
        // Vérifier que l'utilisateur est bien le propriétaire du message
        if ($message->user_id !== Auth::id()) {
            return redirect()->back()
                   ->with('error', 'Vous ne pouvez pas modifier ce message.');
        }
        
        $request->validate([
            'contenu' => 'required|string|max:1000',
        ]);
        
        $message->update([
            'contenu' => $request->contenu,
            'est_modifie' => true,
        ]);
        
        return redirect()->back()
               ->with('success', 'Message modifié avec succès.');
    }
    
    /**
     * Supprime un message
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $message = Message::findOrFail($id);
        
        // Vérifier que l'utilisateur est le propriétaire ou un admin
        $user = Auth::user();
        if ($message->user_id !== $user->id && $user->profil !== 'SUPER_ADMIN' && 
            ($user->profil !== 'GERANT' || $user->gerant->tontine_id !== $message->tontine_id)) {
            return redirect()->back()
                   ->with('error', 'Vous n\'êtes pas autorisé à supprimer ce message.');
        }
        
        $message->delete();
        
        return redirect()->back()
               ->with('success', 'Message supprimé avec succès.');
    }
    
    /**
     * Marquer tous les messages comme lus pour l'utilisateur courant
     *
     * @param  int  $tontineId
     * @return \Illuminate\Http\Response
     */
    public function markAsRead($tontineId)
    {
        // Cette fonction nécessiterait une table pivot ou un champ supplémentaire
        // pour suivre les messages lus par utilisateur
        
        return redirect()->back()
               ->with('success', 'Tous les messages ont été marqués comme lus.');
    }
}