<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\InscriptionController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GerantController;
use App\Http\Controllers\CotisationController;

use App\Http\Controllers\TirageController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\TontineController;
use App\Http\Controllers\UserController;

use App\DataTables\ParticipantsGerantsDataTable;



use App\Http\Controllers\RoleController;

use App\Http\Controllers\MessageController;

use App\Http\Controllers\User2Controller;
use Illuminate\Support\Facades\Route;


// Route::get('/', [InscriptionController::class, 'home'])->name('home');


Route::get('/', function () {
    return redirect('/login');
});


//Inscription utilisateur
Route::get('register', [InscriptionController::class, 'index'])->name('inscription.index');
Route::post('validate-register', [InscriptionController::class, 'register'])
    ->name('inscription.register');


    //Inscription utilisateur
Route::get('register2', [InscriptionController::class, 'index2'])->name('inscription.index2');
Route::post('validate-register2', [InscriptionController::class, 'register2'])->name('inscription.register2');

//Authentification
// Route::get('connexion', [AuthController::class, 'create'])->name('auth.create');
// Route::post('connexion', [AuthController::class, 'auth'])->name('auth.store');

Route::get('login', [AuthController::class, 'create'])->name('login'); 
Route::post('login', [AuthController::class, 'auth'])->name('auth.store');
Route::post('logout', [AuthController::class, 'destroy'])->name('logout');


Route::post('/gerant/tontines/ajouter', [TontineController::class, 'store'])->name('gerant.ajouterTontine');

// Route::get('admin', [AdminController::class, 'index']);
Route::get('/admin', [AdminController::class, 'index'])->name('admin');

// Route::middleware(['auth', 'role:SUPER_ADMIN'])->group(function () {
//     Route::get('/admin', [AdminController::class, 'index'])->name('admin');


// Route::get('/gerant/reclamation', [GerantController::class, 'reclame'])->name('admin.reclamation');

// Route::get('/participant/dashboard', [ParticipantController::class, 'index'])->name('participant.dashboard'); 

// Route::middleware(['auth', 'role:SUPER_ADMIN'])->group(function () {
//     Route::get('/participant/dashboard', [AdminController::class, 'index'])->name('participant.dashboard');
// });
Route::middleware(['auth'])->group(function () {
Route::get('/participant/dashboard', [AdminController::class, 'index'])->name('participant.dashboard');

Route::get('/tirage', [TirageController::class, 'index'])->name('tirage.index');
Route::post('/tirage/draw', [TirageController::class, 'draw'])->name('tirage.draw');
Route::post('/tirage/{idtontine}', [TirageController::class, 'effectuerTirage'])->name('tirage.effectuer');
Route::get('/cotisations/create', [CotisationController::class, 'create'])->name('cotisations.create');
Route::get('/admin/tontinelist', [TontineController::class, 'index'])->name('gerant.tontines');
Route::get('/tontines/{id}', [TontineController::class, 'show'])->name('gerant.detailTontine');
Route::post('/tontines/{id}/participer', [TontineController::class, 'participer'])->name('gerant.participerTontine');
Route::post('/tontines/{id}/quitter', [TontineController::class, 'quitter'])->name('gerant.quitterTontine');
Route::delete('/tontines/{id}', [TontineController::class, 'supprimerTontine'])->name('gerant.supprimerTontine');
Route::get('/tontines/{id}/details', [TontineController::class, 'detailsTontine'])->name('gerant.detailsTontine');
Route::get('/tontines/{id}/edit', [TontineController::class, 'editerTontine'])->name('gerant.editerTontine');
Route::get('/gerant/tontine/{id}/details', [TontineController::class, 'detailsTontine'])->name('gerant.detailsTontine');
// Routes à ajouter pour participer et quitter une tontine
Route::post('/tontine/{id}/participer', [TontineController::class, 'participer'])->name('tontine.participer');
Route::delete('/tontine/{id}/quitter', [TontineController::class, 'quitter'])->name('tontine.quitter');
Route::get('/tontine/paiements/{participantId}', [TontineController::class, 'getPaiements']);
Route::get('/api/tontines/{tontine}/echeances/{user}', 'App\Http\Controllers\CotisationController@getEcheances');
Route::get('/tontine/participant/{participantId}/paiements', [App\Http\Controllers\TontineController::class, 'getPaiements'])->name('tontine.paiements');
Route::get('/navbar', [AuthController::class, 'navbar'])->name('navbar');
Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users');
Route::get('/admin/users/{user}/edit', [UserController::class, 'edit'])->name('admin.edit');
Route::post('/admin/users/{user}', [UserController::class, 'update'])->name('admin.update');
// Role management routes
Route::get('/admin/roles', [RoleController::class, 'index'])->name('admin.roles');
Route::post('/admin/roles', [RoleController::class, 'store'])->name('admin.roles_store');
Route::get('/admin/roles/{role}/edit', [RoleController::class, 'edit'])->name('admin.roles.edit');
Route::put('/admin/roles/{role}', [RoleController::class, 'update'])->name('admin.roles.update');
Route::delete('/admin/roles/{role}', [RoleController::class, 'destroy'])->name('admin.roles.destroy');
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/admin/users/{user}', [UserController::class, 'update'])->name('admin.users.update');
Route::get('assign-permissions-super', [RoleController::class, 'assignPermissionsToSuperRole'])->name('assign.permissions.super');
Route::get('/users/{id}', [UserController::class, 'profile'])->name('user.profile');


// Make sure this route exactly matches the URL format in your JavaScript
Route::post('/tirage/effectuer/{idtontine}', [TirageController::class, 'effectuerTirage'])->name('tirage.effectuer');

// Alternative route format that might work depending on your Laravel setup
Route::post('tirage/effectuer/{idtontine}', [TirageController::class, 'effectuerTirage'])->name('tirage.effectuer.alt');



// });
Route::get('/admin/userlist', [AdminController::class, 'userList'])->name('admin.user-list');
// Route::get('/admin/tontinelist', [AdminController::class, 'tontineList'])->name('admin.tontine-list');
Route::get('/admin/detailTontine', [AdminController::class, 'detailTontine'])->name('admin.detailTontine');
Route::get('/tontines/par-telephone/{telephone}', [CotisationController::class, 'getTontinesByTelephone'])->name('tontines.parTelephone');
Route::post('/cotisations', [CotisationController::class, 'store'])->name('cotisations.store');
Route::get('/cotisations', [CotisationController::class, 'create'])->name('participant.cotisation');
Route::get('/user/calendrier', [CotisationController::class, 'afficherCalendrier'])->name('user.calendrier');
Route::post('/gerant/tontines/creer', [TontineController::class, 'creerTontine'])->name('gerant.creerTontine');
Route::post('/gerant/tontines/{id}/demarrer', [TontineController::class, 'demarrerTontine'])->name('gerant.demarrerTontine');
Route::get('/tontines/{id}', [TontineController::class, 'show'])->name('detail.tontine');
Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
Route::post('/tontine/messages', [MessageController::class, 'store'])->name('user.messages.store');
Route::put('/messages/{id}', [MessageController::class, 'update'])->name('messages.update');
Route::delete('/messages/{id}', [MessageController::class, 'destroy'])->name('messages.destroy');
Route::post('/tontine/{tontineId}/messages/read', [MessageController::class, 'markAsRead'])->name('messages.read');
Route::get('/messages/read-and-show', [MessageController::class, 'markAsReadAndRedirect'])->name('messages.read_and_show');


Route::post('/tirage/{idtontine}', [TirageController::class, 'effectuerTirage'])->name('tirage.effectuer');
// Routes pour la gestion des utilisateurs


});

