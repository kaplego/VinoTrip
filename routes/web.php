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

Route::get('/sejours', action: [SejourController::class, 'list']);

Route::get('/mentions-legales', [SiteController::class, 'mentions']);

Route::get('/politique', [SiteController::class, 'politique']);

Route::get('/destinations', [SiteController::class, 'destinations']);

Route::get('/contact', [SiteController::class, 'contact']);

Route::get('/conditions-vente', [SiteController::class, 'conditions']);

Route::get('/sejour/{id}', action: [SejourController::class, 'one']);
Route::get('/sejour/{id}/edit', [SejourController::class, 'edit']);

Route::post('/sejour/mailpossibilite', [SejourController::class, 'mailpossibilite']);
// Route::get('/sejour/{id}/avis', [SejourController::class, 'edit']);
Route::post('/sejour/{id}/edit/hebergement', [SejourController::class, 'choixhebergement']);
Route::get('/sejours/create', action: [SejourController::class, 'createview']);
Route::get('/sejours/validate', action: [SejourController::class, 'validateview']);
Route::post('/api/edit/changes', [SejourController::class, 'apitogglehebergement']);
Route::post('/api/sejour/{id}/avis', action: [AvisController::class, 'create']);
Route::post('/api/sejour/{id}/update/photo', action: [SejourController::class, 'updatephoto']);
Route::post('/api/sejour/{id}/update', action: [SejourController::class, 'update']);
Route::post('/api/sejours/create', action: [SejourController::class, 'create']);
Route::post('/api/sejour/{id}/publish', action: [SejourController::class, 'publier']);
Route::post('/api/sejour/discount', action: [SejourController::class, 'discount']);
Route::post('/api/sejour/{idsejour}/avis/{idavis}/reply', action: [AvisController::class, 'reply']);
Route::post('/api/sejour/activite/add', action: [ActiviteController::class, 'add']);
Route::post('/api/sejour/activite/delete', action: [ActiviteController::class, 'delete']);
Route::get('/sejours/editing', action: [SejourController::class, 'editing']);

Route::get('/viticoles/list', action: [CategorieVignobleController::class, 'list']);
Route::post('/viticoles/add', [CategorieVignobleController::class, 'add']);
Route::post('/viticoles/delete/{id}', [CategorieVignobleController::class, 'delete']);


Route::get('/connexion', [ClientController::class, 'connexion']);
Route::get('/connexion/a2f', [ClientController::class, 'a2f']);
Route::get('/client', [ClientController::class, 'profil']);
Route::get('/client/informations', [ClientController::class, 'informations']);
Route::get('/client/securite', [ClientController::class, 'securite']);
Route::get('/client/favoris', [FavorisController::class, 'list']);

Route::post('/api/client/favoris/delete', [FavorisController::class, 'delete']);
Route::post('/api/client/favoris/add', [FavorisController::class, 'add']);

Route::get('/client/commandes', [CommandeController::class, 'liste']);
Route::get('/client/commande/{id}', [CommandeController::class, 'recapitulatif']);
Route::get('/client/adresses', [AdresseController::class, 'adresses']);
Route::get('/client/adresse/{id}/modifier', [AdresseController::class, 'modifier']);
Route::get('/client/adresse/ajouter', [AdresseController::class, 'ajouter']);


Route::put('/api/client/a2f', [ClientController::class, 'a2ftoggle']);
Route::post('/api/client/a2f', [ClientController::class, 'a2ftoggle']);
Route::get('/api/client/a2f', [ClientController::class, 'a2ftoggle']);
Route::delete('/api/client/a2f', [ClientController::class, 'a2ftoggle']);

Route::put('/api/client/a2f/login', [ClientController::class, 'a2fauth']);
Route::post('/api/client/a2f/login', [ClientController::class, 'a2fauth']);
Route::get('/api/client/a2f/login', [ClientController::class, 'a2fauth']);
Route::delete('/api/client/a2f/login', [ClientController::class, 'a2fauth']);

Route::post('/api/client/adresse/modifier', [AdresseController::class, 'edit']);
Route::post('/api/client/adresse/add', [AdresseController::class, 'add']);
Route::post('/api/client/adresse/firstaddress', [AdresseController::class, 'firstaddress']);

Route::post('/api/client/adresse/delete', [AdresseController::class, 'delete']);

Route::post('/api/client/login', [ClientController::class, 'login']);
Route::post('/api/client/logout', [ClientController::class, 'logout']);
Route::post('/api/client/signin', [ClientController::class, 'signin']);
Route::post('/api/client/edit', [ClientController::class, 'edit']);
Route::post('/api/client/resetmdp', [ClientController::class, 'envoiemailmdp']);
route::post('/api/client/rgpd', [ClientController::class, 'callDBFunction']);

Route::get('/panier', [PanierController::class, 'index']);
Route::get('/panier/paiement', [PanierController::class, 'paiement']);
Route::post('/api/panier/add', [PanierController::class, 'add']);
Route::post('/api/panier/update', [PanierController::class, 'update']);
Route::post('/api/panier/payment', [PanierController::class, 'payment']);
Route::post('/api/panier/codepromo', [PanierController::class, 'codepromo']);

Route::get('/personnaliser/{id}', [PanierController::class, 'personnaliser']);
Route::get('/modifier/{idsejour}', [PanierController::class, 'modifier']);

Route::get('/reservation', [ReservationHotelController::class, 'listReservation']);
Route::post('/api/reservationhotel', [ReservationHotelController::class, 'envoiemailhotel']);
Route::post('/api/reservationclient', [ReservationHotelController::class, 'envoiemailclient']);
Route::post('/api/validationcommande', [ReservationHotelController::class, 'confirmationCommande']);
Route::post('/api/reservationok', [ReservationHotelController::class, 'hebergementok']);
Route::post('/api/clientok', [ReservationHotelController::class, 'clientok']);
Route::post('/api/clientnon', [ReservationHotelController::class, 'clientnon']);

Route::get('/routes-des-vins', [RoutesVinsController::class, 'list']);
Route::get('/route-des-vins/{id}', [RoutesVinsController::class, 'one']);

Route::get('/mdpreset/{token}', [ClientController::class, 'resetPassword']);

Route::post('/api/client/mdpreset/{token}', [ClientController::class, 'updatePassword']);

Route::post('/api/dialogflow', [SiteController::class, 'dialogflow']);

Route::post('/api/client/clientdata/{id}', [ClientController::class, 'sendclientdata']);

Route::post('/api/client/anonymiser/{id}', [ClientController::class, 'anonymiser']);

Route::post('/api/client/supprimer/{id}', [ClientController::class, 'supprimerInformations']);


# Route de test
Route::get('/test', [SiteController::class, 'test']);
