<?php

use App\Http\Controllers\AdresseController;
use App\Http\Controllers\PanierController;
use App\Http\Controllers\SejourController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\AvisController;
use App\Http\Controllers\ReservationHotelController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\RoutesVinsController;
use App\Http\Controllers\MailController;
use App\Models\Descriptioncommande;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [SiteController::class, 'index']);

Route::get('/avis', action: [AvisController::class, 'list']);

Route::get('/sejours', action: [SejourController::class, 'list']);

Route::get('/mentions-legales', [SiteController::class, 'mentions']);

Route::get('/politique', [SiteController::class, 'politique']);

Route::get('/destinations', [SiteController::class, 'destinations']);

Route::get('/contact', [SiteController::class, 'contact']);

Route::get('/conditions-vente', [SiteController::class, 'conditions']);

Route::get('/sejour/{id}', [SejourController::class, 'one']);
Route::get('/sejour/{id}/edit', [SejourController::class, 'edit']);
Route::post('/sejour/{idsejour}/edit/choix', [SejourController::class, 'choixhebergement']);
Route::post('/api/sejour/{idsejour}/edit/changes', [SejourController::class, 'apitogglehebergement']);

Route::get('/connexion', [ClientController::class, 'connexion']);
Route::get('/client', [ClientController::class, 'profil']);
Route::get('/client/informations', [ClientController::class, 'informations']);

Route::get('/client/adresses', [AdresseController::class, 'adresses']);
Route::get('/client/adresse/{id}/modifier', [AdresseController::class, 'modifier']);
Route::get('/client/adresse/ajouter', [AdresseController::class, 'ajouter']);

Route::post('/api/client/adresse/modifier', [AdresseController::class, 'edit']);
Route::post('/api/client/adresse/add', [AdresseController::class, 'add']);
Route::post('/api/client/adresse/delete', [AdresseController::class, 'edit']);


Route::post('/api/client/login', [ClientController::class, 'login']);
Route::post('/api/client/logout', [ClientController::class, 'logout']);
Route::post('/api/client/signin', [ClientController::class, 'signin']);
Route::post('/api/client/edit', [ClientController::class, 'edit']);

Route::get('/panier', [PanierController::class, 'index']);
Route::get('/panier/paiement', [PanierController::class, 'paiement']);
Route::post('/api/panier/add', [PanierController::class, 'add']);
Route::post('/api/panier/update', [PanierController::class, 'update']);
Route::post('/api/panier/payment', [PanierController::class, 'payment']);

Route::get('/personnaliser/{id}', [PanierController::class, 'personnaliser']);
Route::get('/modifier/{idsejour}', [PanierController::class, 'modifier']);

Route::get('/reservation', [ReservationHotelController::class, 'listReservation']);
Route::post('/api/reservationhotel', [ReservationHotelController::class, 'envoiemailhotel']);
Route::post('/api/reservationclient', [ReservationHotelController::class, 'envoiemailclient']);


Route::get('/route-des-vins', [RoutesVinsController::class, 'list']);
Route::get('/route-des-vins/{id}', [RoutesVinsController::class, 'one']);
