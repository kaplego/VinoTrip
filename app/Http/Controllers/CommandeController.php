<?php

namespace App\Http\Controllers;

use App\Models\VCommande;
use Auth;

class CommandeController extends Controller
{
    public function liste()
    {
        if (!Auth::check())
            return to_route('login');

        return view('client.commande.liste', ['commandes' => Auth::user()->commandes]);
    }

    public function recapitulatif($id)
    {
        if (!Auth::check())
            return to_route('login');

        $commande = VCommande::find($id)?->where('idclientacheteur', '=', Auth::user()->idclient);

        if (!$commande)
            return to_route('client');

        return view('client.commande.recapitulatif', ['commande' => VCommande::find($id)]);
    }
}
