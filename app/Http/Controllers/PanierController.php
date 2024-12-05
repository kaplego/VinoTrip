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
        $sejour = Sejour::find($idsejour);

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

        $descriptionPanier = Descriptionpanier::
            where('idsejour', '=', +$idsejour)
            ->where('idpanier', '=', value: $idpanier)
            ->get()->first();

        if ($descriptionPanier === null) {
            Descriptionpanier::
                create([
                    'idsejour' => $sejour->idsejour,
                    'idpanier' => $panier->idpanier,
                    'prix' => $sejour->prixsejour,
                    'quantite' => 1,
                    'datedebut' => now(),
                    'datefin' => now()->addDays(2),
                    'nbadultes' => 1,
                    'nbenfants' => 0,
                    'nbchambressimple' => 1,
                    'nbchambresdouble' => 0,
                    'nbchambrestriple' => 0,
                    'repasmidi' => false,
                    'repassoir' => false,
                    'activite' => false,
                ]);
        } else {
            Descriptionpanier::
                where('idsejour', '=', +$idsejour)
                ->where('idpanier', '=', value: $idpanier)
                ->update([
                    'quantite' => $descriptionPanier->quantite + 1
                ]);
        }

        return redirect('/panier');
    }

    public function update(Request $request)
    {
        $idsejour = $request->input('idsejour') ?? null;
        $idpanier = $request->session()->get('idpanier', null);

        $action = $request->input('action');

        switch ($action) {
            case 'delete':
                Descriptionpanier::
                    where('idsejour', '=', +$idsejour)
                    ->where('idpanier', '=', value: $idpanier)
                    ->delete();

                if (
                    Descriptionpanier::where('idpanier', '=', value: $idpanier)->count() === 0
                ) {
                    Panier::find($idpanier)->delete();
                }
                break;
            case 'update':
                $quantite = +$request->input('quantite');
                if ($quantite > 0)
                    Descriptionpanier::
                        where('idsejour', '=', +$idsejour)
                        ->where('idpanier', '=', value: $idpanier)
                        ->update([
                            'quantite' => $quantite
                        ]);
                break;
        }

        return redirect('/panier');
    }

    public function offrir($id)
    {
        $sejour = Sejour::find($id);

        return view('offrir', ['sejour' => $sejour]);
    }


}



