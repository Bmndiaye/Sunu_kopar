<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\InscriptionController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GerantController;
use App\Http\Controllers\CotisationController;

use App\Http\Controllers\TirageController;
use App\Http\Controllers\ParticipantController;



use Illuminate\Support\Facades\Route;

// Route::get('/', [InscriptionController::class, 'home'])->name('home');

//Inscription utilisateur
Route::get('register', [InscriptionController::class, 'index'])->name('inscription.index');
Route::post('validate-register', [InscriptionController::class, 'register'])
    ->name('inscription.register');

//Authentification
// Route::get('connexion', [AuthController::class, 'create'])->name('auth.create');
// Route::post('connexion', [AuthController::class, 'auth'])->name('auth.store');

Route::get('connexion', [AuthController::class, 'create'])->name('auth.create')->name('connexion');
Route::post('connexion', [AuthController::class, 'auth'])->name('auth.store');


// Route::get('admin', [AdminController::class, 'index']);
Route::get('/admin', [AdminController::class, 'index'])->name('admin');

// Route::middleware(['auth', 'role:SUPER_ADMIN'])->group(function () {
//     Route::get('/admin', [AdminController::class, 'index'])->name('admin');
// });


Route::get('/admin/userlist', [AdminController::class, 'userList'])->name('admin.user-list');
Route::get('/admin/tontinelist', [AdminController::class, 'tontineList'])->name('admin.tontine-list');
Route::get('/admin/detailTontine', [AdminController::class, 'detailTontine'])->name('admin.detailTontine');


Route::get('/tontines/par-telephone/{telephone}', [CotisationController::class, 'getTontinesByTelephone'])->name('tontines.parTelephone');
Route::post('/cotisations', [CotisationController::class, 'store'])->name('cotisations.store');



// Route::get('/gerant/reclamation', [GerantController::class, 'reclame'])->name('admin.reclamation');

Route::get('/participant/dashboard', [ParticipantController::class, 'index'])->name('participant.dashboard'); // 🔥 Ajoute cette ligne


Route::get('/tirage', [TirageController::class, 'index'])->name('tirage.index');
Route::post('/tirage/draw', [TirageController::class, 'draw'])->name('tirage.draw');
Route::post('/tirage/{idTontine}', [TirageController::class, 'effectuerTirage'])->name('tirage.effectuer');



