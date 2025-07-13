<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdhesionController;
use App\Http\Controllers\ConnexionController;
use App\Http\Controllers\MembreController;
use App\Http\Controllers\EvenementController;
use App\Http\Controllers\CotisationController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\InscriptionController;
use App\Http\Controllers\DashboardController;

// 🔐 Authentification
Route::post('/login', [ConnexionController::class, 'login']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// 👤 Membres
Route::get('/membres', [MembreController::class, 'index']);
Route::get('/membres/{id}', [MembreController::class, 'show']);
Route::post('/membres', [MembreController::class, 'store']);
Route::put('/membres/{id}', [MembreController::class, 'update']);
Route::delete('/membres/{id}', [MembreController::class, 'destroy']);

// 📝 Adhésion
Route::post('/adhesion', [AdhesionController::class, 'store']);

// 📅 Événements (CRUD complet)
Route::apiResource('evenements', EvenementController::class);

// 💰 Cotisations
Route::get('/cotisations/disponibles', [CotisationController::class, 'cotisationsDisponibles']); // personnalisée
Route::get('/cotisations-pour-paiement', [PaiementController::class, 'cotisations']); // via PaiementController
Route::apiResource('cotisations', CotisationController::class)->except(['show']);

// 💳 Paiements
Route::get('/paiements', [PaiementController::class, 'index']);
Route::get('/paiements/membre/{id}', [PaiementController::class, 'paiementsParMembre']); // ⚠️ ajout essentiel
Route::post('/paiements', [PaiementController::class, 'store']);
Route::put('/paiements/{id}', [PaiementController::class, 'update']);
Route::delete('/paiements/{id}', [PaiementController::class, 'destroy']);

// 📌 Infos complémentaires
Route::get('/membres-adhesion', [PaiementController::class, 'membres']);

// 📝 Inscriptions à un événement
Route::post('/inscriptions', [InscriptionController::class, 'store']);
Route::get('/inscriptions/{membreId}', [InscriptionController::class, 'mesInscriptions']);

Route::get('/dashboard/stats', [DashboardController::class, 'stats']);
