<?php

use App\Http\Controllers\PanierController;
use App\Http\Controllers\SejourController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\AvisController;

use App\Http\Controllers\SiteController;
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

Route::get('/connexion', [ClientController::class, 'connexion']);
Route::get('/profil', [ClientController::class, 'profil']);
Route::get('/profil/informations', [ClientController::class, 'informations']);

Route::post('/api/client/login', [ClientController::class, 'login']);
Route::post('/api/client/logout', [ClientController::class, 'logout']);
Route::post('/api/client/signin', [ClientController::class, 'signin']);
Route::post('/api/client/edit', [ClientController::class, 'edit']);


Route::get('/panier', [PanierController::class, 'index']);
Route::post('/api/panier/add', [PanierController::class, 'ajouter']);
Route::post('/api/panier/update', [PanierController::class, 'update']);

Route::get('/personnaliser/{id}', [PanierController::class, 'personnaliser']);
Route::get('/modifier/{idsejour}', [PanierController::class, 'modifier']);
