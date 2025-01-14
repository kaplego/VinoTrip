<?php

use App\Http\Controllers\ActiviteController;
use App\Http\Controllers\AdresseController;
use App\Http\Controllers\CategorieVignobleController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\FavorisController;
use App\Http\Controllers\PanierController;
use App\Http\Controllers\SejourController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\AvisController;
use App\Http\Controllers\ReservationHotelController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\RoutesVinsController;
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

Route::get('/mentions-legales', [SiteController::class, 'mentions']);
Route::get('/politique', [SiteController::class, 'politique']);
Route::get('/conditions-vente', [SiteController::class, 'conditions']);
Route::get('/aide', [SiteController::class, 'aide']);

Route::post('/api/dialogflow', [SiteController::class, 'dialogflow']);

// =============== SEJOURS

// GET
Route::get('/sejours', action: [SejourController::class, 'list']);
Route::get('/sejour/{id}', action: [SejourController::class, 'one']);
Route::get('/sejour/{id}/edit', [SejourController::class, 'edit']);
Route::get('/sejours/create', action: [SejourController::class, 'createview']);
Route::get('/sejours/validate', action: [SejourController::class, 'validateview']);

// POST
Route::post('/api/sejour/{idsejour}/hotels/email', [SejourController::class, 'mailpossibilite']);
Route::post('/api/sejour/{idsejour}/etape/{idetape}/edithebergement', [SejourController::class, 'choixhebergement']);
Route::post('/api/sejour/{idsejour}/etape/{idetape}/hebergement', [SejourController::class, 'apihebergement']);
Route::post('/api/sejour/{idsejour}/avis', action: [AvisController::class, 'create']);
Route::post('/api/sejour/{idsejour}/update/photo', action: [SejourController::class, 'updatephoto']);
Route::post('/api/sejour/{idsejour}/update', action: [SejourController::class, 'update']);
Route::post('/api/sejour/{idsejour}/photo/{idphoto}/delete', [SejourController::class, 'removephoto']);
Route::post('/api/sejours/create', action: [SejourController::class, 'create']);
Route::post('/api/sejour/{idsejour}/publish', action: [SejourController::class, 'publier']);
Route::post('/api/sejour/{idsejour}/discount', action: [SejourController::class, 'discount']);
Route::post('/api/sejour/{idsejour}/avis/{idavis}/reply', action: [AvisController::class, 'reply']);
Route::post('/api/etape/{idetape}/activite/add', action: [ActiviteController::class, 'add']);
Route::post('/api/etape/{idetape}/activite/{idactivite}/delete', action: [ActiviteController::class, 'delete']);

// =============== VITICOLES

// GET
Route::get('/viticoles/list', action: [CategorieVignobleController::class, 'list']);

// POST
Route::post('/api/viticoles/add', [CategorieVignobleController::class, 'add']);
Route::post('/api/viticoles/{idviticole}/delete', [CategorieVignobleController::class, 'delete']);

// =============== CLIENT / AUTH

// GET
Route::get('/connexion', [ClientController::class, 'connexion']);
Route::get('/connexion/a2f', [ClientController::class, 'a2f']);
Route::get('/client', [ClientController::class, 'profil']);
Route::get('/client/informations', [ClientController::class, 'informations']);
Route::get('/client/securite', [ClientController::class, 'securite']);
Route::get('/client/reset-password/{token}', [ClientController::class, 'resetPassword']);

// POST
Route::post('/api/client/login', [ClientController::class, 'login']);
Route::post('/api/client/logout', [ClientController::class, 'logout']);
Route::post('/api/client/signin', [ClientController::class, 'signin']);
Route::post('/api/client/edit', [ClientController::class, 'edit']);
Route::post('/api/client/resetmdp', [ClientController::class, 'envoiemailmdp']);
route::post('/api/client/rgpd', [ClientController::class, 'callDBFunction']);
Route::post('/api/client/reset-password/{token}', [ClientController::class, 'updatePassword']);
Route::post('/api/client/clientdata/{id}', [ClientController::class, 'sendclientdata']);
Route::post('/api/client/anonymiser/{id}', [ClientController::class, 'anonymiser']);
Route::post('/api/client/supprimer/{id}', [ClientController::class, 'supprimerInformations']);

// =============== ADRESSES

// GET
Route::get('/client/adresses', [AdresseController::class, 'adresses']);
Route::get('/client/adresse/{id}/modifier', [AdresseController::class, 'modifier']);
Route::get('/client/adresse/ajouter', [AdresseController::class, 'ajouter']);

// POST
Route::post('/api/client/adresse/{idadresse}/modifier', [AdresseController::class, 'edit']);
Route::post('/api/client/adresse/add', [AdresseController::class, 'add']);
Route::post('/api/client/adresse/firstaddress', [AdresseController::class, 'firstaddress']);
Route::post('/api/client/adresse/delete', [AdresseController::class, 'delete']);

// =============== FAVORIS

// GET
Route::get('/client/favoris', [FavorisController::class, 'list']);

// POST
Route::post('/api/client/favoris/delete', [FavorisController::class, 'delete']);
Route::post('/api/client/favoris/add', [FavorisController::class, 'add']);

// =============== COMMANDES

// GET
Route::get('/client/commandes', [CommandeController::class, 'liste']);
Route::get('/client/commande/{id}', [CommandeController::class, 'recapitulatif']);

// POST
Route::post('/api/client/{idclient}/confirmer/{iddescriptioncommande}', [ReservationHotelController::class, 'confirmationCommande']);

// =============== PANIER

// GET
Route::get('/personnaliser/{id}', [PanierController::class, 'personnaliser']);
Route::get('/panier', [PanierController::class, 'index']);
Route::get('/panier/paiement', [PanierController::class, 'paiement']);
Route::get('/modifier/{idsejour}', [PanierController::class, 'modifier']);

// POST
Route::post('/api/panier/add', [PanierController::class, 'add']);
Route::post('/api/panier/update', [PanierController::class, 'update']);
Route::post('/api/panier/payment', [PanierController::class, 'payment']);
Route::post('/api/panier/codepromo', [PanierController::class, 'codepromo']);

// =============== RESERVATION

// GET
Route::get('/reservation', [ReservationHotelController::class, 'listReservation']);

// POST
Route::post('/api/reservationhotel', [ReservationHotelController::class, 'envoiemailhotel']);
Route::post('/api/reservationclient', [ReservationHotelController::class, 'envoiemailclient']);
Route::post('/api/reservationok', [ReservationHotelController::class, 'hebergementok']);
Route::post('/api/clientok', [ReservationHotelController::class, 'clientok']);
Route::post('/api/clientnon', [ReservationHotelController::class, 'clientnon']);

// =============== ROUTE DES VINS

Route::get('/routes-des-vins', [RoutesVinsController::class, 'list']);
Route::get('/route-des-vins/{id}', [RoutesVinsController::class, 'one']);

// =============== A2F

Route::put('/api/client/a2f', [ClientController::class, 'a2ftoggle']);
Route::post('/api/client/a2f', [ClientController::class, 'a2ftoggle']);
Route::get('/api/client/a2f', [ClientController::class, 'a2ftoggle']);
Route::delete('/api/client/a2f', [ClientController::class, 'a2ftoggle']);

Route::put('/api/client/a2f/login', [ClientController::class, 'a2fauth']);
Route::post('/api/client/a2f/login', [ClientController::class, 'a2fauth']);
Route::get('/api/client/a2f/login', [ClientController::class, 'a2fauth']);
Route::delete('/api/client/a2f/login', [ClientController::class, 'a2fauth']);
