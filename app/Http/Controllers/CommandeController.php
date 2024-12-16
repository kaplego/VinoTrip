<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use Illuminate\Http\Request;

class CommandeController extends Controller
{
    public function liste()
    {
        return view('client.commande.liste', ['commandes' => Commande::all()]);
    }

    public function recapitulatif()
    {
        return view('client.commande.recapitulatif', ['commande' => Commande::all()]);
    }
}
