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

Route::get('/', [SiteController::class, 'index'])->name('welcome');

Route::get('/avis', action: [AvisController::class, 'list'])->name('avis');

Route::get('/mentions-legales', [SiteController::class, 'mentions'])->name('legal.mentions');
Route::get('/politique', [SiteController::class, 'politique'])->name('legal.confidentialite');
Route::get('/conditions-vente', [SiteController::class, 'conditions'])->name('legal.cdv');
Route::get('/aide', [SiteController::class, 'aide'])->name('aide');

Route::post('/api/dialogflow', [SiteController::class, 'dialogflow']);

// =============== SEJOURS

// GET
Route::get('/sejours', action: [SejourController::class, 'list'])->name('sejours');
Route::get('/sejour/{idsejour}', action: [SejourController::class, 'one'])->name('sejour');
Route::get('/sejour/{idsejour}/edit', [SejourController::class, 'edit'])->name('sejour.edit');
Route::get('/sejours/create', action: [SejourController::class, 'createview'])->name('sejours.create');
Route::get('/sejours/validate', action: [SejourController::class, 'validateview'])->name('sejours.unpublished');

// POST
Route::post('/api/sejour/{idsejour}/hotels/email', [SejourController::class, 'mailpossibilite'])->name('api.sejour-hotel');
Route::post('/api/sejour/{idsejour}/etape/{idetape}/edithebergement', [SejourController::class, 'choixhebergement'])->name('api.sejour-hebergement-edit');
Route::post('/api/sejour/{idsejour}/etape/{idetape}/hebergement', [SejourController::class, 'apihebergement'])->name('api.sejour-hebergement');
Route::post('/api/sejour/{idsejour}/avis', action: [AvisController::class, 'create'])->name('api.sejour-avis');
Route::post('/api/sejour/{idsejour}/update', action: [SejourController::class, 'update'])->name('api.sejour-update');
Route::post('/api/sejour/{idsejour}/photo/add', action: [SejourController::class, 'updatephoto'])->name('api.sejour-photo.add');
Route::post('/api/sejour/{idsejour}/photo/{idphoto}/delete', [SejourController::class, 'removephoto'])->name('api.sejour-photo.remove');
Route::post('/api/sejours/create', action: [SejourController::class, 'create'])->name('api.sejour-create');
Route::post('/api/sejour/{idsejour}/publish', action: [SejourController::class, 'publier'])->name('api.sejour-publish');
Route::post('/api/sejour/{idsejour}/discount', action: [SejourController::class, 'discount'])->name('api.sejour-discount');
Route::post('/api/sejour/{idsejour}/avis/{idavis}/reply', action: [AvisController::class, 'reply'])->name('api.sejour-avis.reply');
Route::post('/api/etape/{idetape}/activite/add', action: [ActiviteController::class, 'add'])->name('api.etape-activite.add');
Route::post('/api/etape/{idetape}/activite/{idactivite}/delete', action: [ActiviteController::class, 'delete'])->name('api.etape-activite.remove');

// =============== VITICOLES

// GET
Route::get('/viticoles/list', action: [CategorieVignobleController::class, 'list'])->name('viticoles');

// POST
Route::post('/api/viticoles/add', [CategorieVignobleController::class, 'add'])->name('api.viticole.add');
Route::post('/api/viticoles/{idviticole}/delete', [CategorieVignobleController::class, 'delete'])->name('api.viticole.remove');

// =============== CLIENT / AUTH

// GET
Route::get('/connexion', [ClientController::class, 'connexion'])->name('login');
Route::get('/connexion/a2f', [ClientController::class, 'a2f'])->name('a2f');
Route::get('/client', [ClientController::class, 'profil'])->name('client');
Route::get('/client/informations', [ClientController::class, 'informations'])->name('client.infos');
Route::get('/client/securite', [ClientController::class, 'securite'])->name('client.securite');
Route::get('/client/reset-password/{token}', [ClientController::class, 'resetPassword'])->name('client.reset-pswd');

// POST
Route::post('/api/client/login', [ClientController::class, 'login'])->name('api.login');
Route::post('/api/client/logout', [ClientController::class, 'logout'])->name('api.logout');
Route::post('/api/client/signin', [ClientController::class, 'signin'])->name('api.signin');
Route::post('/api/client/edit', [ClientController::class, 'edit'])->name('api.client-edit');
Route::post('/api/client/resetmdp', [ClientController::class, 'envoiemailmdp'])->name('api.client-reset');
route::post('/api/client/rgpd', [ClientController::class, 'callDBFunction'])->name('api.client-rgpd');
Route::post('/api/client/reset-password/{token}', [ClientController::class, 'updatePassword'])->name('api.client-reset.token');
Route::post('/api/client/clientdata', [ClientController::class, 'sendclientdata'])->name('api.client-data');
Route::post('/api/client/anonymiser', [ClientController::class, 'anonymiser'])->name('api.client-anonymiser');
Route::post('/api/client/supprimer', [ClientController::class, 'supprimerInformations'])->name('api.client-supprimer');

// =============== ADRESSES

// GET
Route::get('/client/adresses', [AdresseController::class, 'adresses'])->name('adresses');
Route::get('/client/adresse/{id}/modifier', [AdresseController::class, 'modifier'])->name('adresse');
Route::get('/client/adresse/ajouter', [AdresseController::class, 'ajouter'])->name('adresses.create');

// POST
Route::post('/api/client/adresse/{idadresse}/modifier', [AdresseController::class, 'edit'])->name('api.adresse.edit');
Route::post('/api/client/adresse/add', [AdresseController::class, 'add'])->name('api.adresse.add');
Route::post('/api/client/adresse/firstaddress', [AdresseController::class, 'firstaddress'])->name('api.adresse.first');
Route::post('/api/client/adresse/delete', [AdresseController::class, 'delete'])->name('api.adresse.delete');

// =============== FAVORIS

// GET
Route::get('/client/favoris', [FavorisController::class, 'list'])->name('favoris');

// POST
Route::post('/api/client/favoris/{idsejour}/add', [FavorisController::class, 'add'])->name('api.favoris.add');
Route::post('/api/client/favoris/{idsejour}/delete', [FavorisController::class, 'delete'])->name('api.favoris.remove');

// =============== COMMANDES

// GET
Route::get('/client/commandes', [CommandeController::class, 'liste'])->name('commandes');
Route::get('/client/commande/{id}', [CommandeController::class, 'recapitulatif'])->name('commande');

// POST
Route::post('/api/client/{idclient}/confirmer/{iddescriptioncommande}', [ReservationHotelController::class, 'confirmationCommande'])->name('api.commande.confirm');

// =============== PANIER

// GET
Route::get('/personnaliser/{idsejour}', [PanierController::class, 'personnaliser'])->name('personnaliser');
Route::get('/panier', [PanierController::class, 'index'])->name('panier');
Route::get('/panier/paiement', [PanierController::class, 'paiement'])->name('paiement');
Route::get('/modifier/{idsejour}', [PanierController::class, 'modifier'])->name('panier.modifier');

// POST
Route::post('/api/panier/add', [PanierController::class, 'add'])->name('api.panier.add');
Route::post('/api/panier/update', [PanierController::class, 'update'])->name('api.panier.update');
Route::post('/api/panier/payment', [PanierController::class, 'payment'])->name('api.panier.payment');
Route::post('/api/panier/codepromo', [PanierController::class, 'codepromo'])->name('api.panier.promo');

// =============== RESERVATION

// GET
Route::get('/reservations', [ReservationHotelController::class, 'listReservation'])->name('reservations');

// POST
Route::post('/api/reservationhotel', [ReservationHotelController::class, 'envoiemailhotel'])->name('api.reserv.hotel');
Route::post('/api/reservationclient', [ReservationHotelController::class, 'envoiemailclient'])->name('api.reserv.client');
Route::post('/api/reservationok', [ReservationHotelController::class, 'hebergementok'])->name('api.reserv.ok');
Route::post('/api/clientok', [ReservationHotelController::class, 'clientok'])->name('api.clientok');
Route::post('/api/clientnon', [ReservationHotelController::class, 'clientnon'])->name('api.clientnon');

// =============== ROUTE DES VINS

Route::get('/routes-des-vins', [RoutesVinsController::class, 'list'])->name('routes-vins');
Route::get('/route-des-vins/{id}', [RoutesVinsController::class, 'one'])->name('route-vins');

// =============== A2F

Route::put('/api/client/a2f', [ClientController::class, 'a2ftoggle']);
Route::post('/api/client/a2f', [ClientController::class, 'a2ftoggle']);
Route::get('/api/client/a2f', [ClientController::class, 'a2ftoggle']);
Route::delete('/api/client/a2f', [ClientController::class, 'a2ftoggle']);

Route::put('/api/client/a2f/login', [ClientController::class, 'a2fauth']);
Route::post('/api/client/a2f/login', [ClientController::class, 'a2fauth']);
Route::get('/api/client/a2f/login', [ClientController::class, 'a2fauth']);
Route::delete('/api/client/a2f/login', [ClientController::class, 'a2fauth']);
