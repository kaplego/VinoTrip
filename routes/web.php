<?php

use App\Http\Controllers\SejourController;
use App\Http\Controllers\ClientController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/sejours', [SejourController::class, 'list']);

Route::get('/mentions-legales', [SiteController::class,'mentions']);

Route::get('/politique', [SiteController::class,'politique']);

Route::get('/contact', [SiteController::class,'contact']);

Route::get('/conditions-vente', [SiteController::class,'conditions']);

Route::get('/sejour/{id}', [SejourController::class, 'one']);

Route::get('/authentification', [ClientController::class,'authentification']);

Route::post('/compte', [ClientController::class,'compte']);
