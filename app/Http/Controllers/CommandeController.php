<?php

namespace App\Http\Controllers;

use App\Models\VCommande;
use Auth;

class CommandeController extends Controller
{
    public function liste()
    {
        if (!Auth::check())
            return redirect('/connexion');

        return view('client.commande.liste', ['commandes' => Auth::user()->commandes]);
    }

    public function recapitulatif($id)
    {
        if (!Auth::check())
            return redirect('/connexion');

        $commande = VCommande::find($id)?->where('idclientacheteur', '=', Auth::user()->idclient);

        if (!$commande)
            return redirect('/client');

        return view('client.commande.recapitulatif', ['commande' => VCommande::find($id)]);
    }
}
