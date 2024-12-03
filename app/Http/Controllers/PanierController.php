<?php

namespace App\Http\Controllers;

use App\Models\Descriptionpanier;
use App\Models\Panier;
use App\Models\Sejour;
use Illuminate\Http\Request;

class PanierController extends Controller
{
    public function index(Request $request)
    {
        $idpanier = $request->session()->get('idpanier', null);

        $panier = null;
        if ($idpanier !== null) {
            $panier = Panier::find($idpanier);
        }

        return view("panier", ["panier" => $panier]);
    }

    public function ajouter(Request $request)
    {
        $idsejour = $request->input('idsejour') ?? null;
        $sejour = Sejour::find($idsejour)->first();

        if ($sejour === null)
            return redirect('/panier');

        $idpanier = $request->session()->get('idpanier', null);

        $panier = Panier::find($idpanier);
        if ($panier === null) {
            $panier = new Panier;
            $panier->dateheurepanier = now();
            $panier->save();

            $request->session()->put('idpanier', $panier->idpanier);
        }

        $descriptionPanier = new Descriptionpanier;

        $descriptionPanier->idsejour = $sejour->idsejour;
        $descriptionPanier->idpanier = $panier->idpanier;
        $descriptionPanier->prix = $sejour->prixsejour;
        $descriptionPanier->quantite = 1;
        $descriptionPanier->datedebut = now();
        $descriptionPanier->datefin = now()->addDays(2);
        $descriptionPanier->nbadultes = 1;
        $descriptionPanier->nbenfants = 0;
        $descriptionPanier->nbchambressimple = 1;
        $descriptionPanier->nbchambresdouble = 0;
        $descriptionPanier->nbchambrestriple = 0;
        $descriptionPanier->repasmidi = false;
        $descriptionPanier->repassoir = false;
        $descriptionPanier->activite = false;

        $descriptionPanier->save();

        return redirect('/panier');
    }
}
