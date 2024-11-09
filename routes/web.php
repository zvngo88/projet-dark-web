<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\HIBPController;

Route::get('/', function () {
    return view('welcome');
});

// Groupe de routes pour les utilisateurs authentifiés
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // Tableau de bord
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Route pour la recherche des données déjà crawlées
    Route::get('/search', [SearchController::class, 'search'])->name('search');

    // Gestion des utilisateurs (uniquement accessible aux administrateurs)
    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
        Route::resource('users', UserController::class)->except(['show', 'create', 'store']);
    });
});

// Route de recherche par email avec gestion des résultats
Route::match(['get', 'post'], '/search/email', [HIBPController::class, 'showEmailSearch'])->name('search.email');


// (Optionnel) Routes pour la recherche par domaine
Route::get('/search/domain', function () {
    return view('hibp.search_domain');
})->name('search.domain');

Route::post('/search/domain', [HIBPController::class, 'searchDomain'])->name('search.domain.post');
