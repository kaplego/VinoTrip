<?php

namespace App\Http\Controllers;

use App\Models\Categorieparticipant;
use App\Models\Categoriesejour;
use App\Models\Categorievignoble;
use App\Models\Cave;
use App\Models\Duree;
use App\Models\Etape;
use App\Models\Hebergement;
use App\Models\Hotel;
use App\Models\Sejour;
use App\Models\Localite;


use App\Models\Visite;
use Auth;
use Illuminate\Http\Request;

class SejourController extends Controller
{
    public function list()
    {
        return view('sejours.list', [
            'sejours' => Sejour::orderBy('idsejour')->get(),
            'categoriesejour' => Categoriesejour::all(),
            'categorieparticipant' => Categorieparticipant::all(),
            'categoriesvignoble' => Categorievignoble::all(),
            'localites' => Localite::all(),
            'durees' => Duree::all(),
        ]);
    }

    public function one($id)
    {
        return view ('sejours.summary', [
            'sejour'=>Sejour::find($id),
            'hebergement' => Hebergement::all(),
            'visite' => Visite::all(),
            'hotel' => Hotel::all(),
            'cave' => Cave::all(),
        ]);
    }

    public function edit($id)
    {
        if(!Auth::check() || Auth::user()->idrole != 3)
        {
            return redirect("/sejour/$id");
        }
        return view ('sejours.edit-sejour', [
            'sejour'=>Sejour::find($id),
            'hebergement' => Hebergement::all(),
            'visite' => Visite::all(),
            'hotel' => Hotel::all(),
            'cave' => Cave::all(),
        ]);
    }

    public function apitogglehebergement($idsejour, Request $request)
    {
        $idetape = $request->input('idetape');
        $newidhebergement = $request->input('newidhebergement');

        $etape = Etape::find($idetape);
        $etape->idhebergement = $newidhebergement;

        $etape->update();
        return redirect("/sejour/$idsejour/edit");

    }
    public function choixhebergement($idsejour, Request $request)
    {
        $idhebergement = $request->input('idhebergement');
        $idetape = $request->input('idetape');

        $hebergement = Hebergement::find($idhebergement);
        $hebergement->disponibilitehebergement = !$hebergement->disponibilitehebergement;

        $hebergement->update();
        return view("sejours.edit-list-hebergement", [
            'sejour'=>Sejour::find($idsejour),
            'hebergements' => Hebergement::all(),
            'idetape' => $request->input('idetape'),
            'idhebergement' => $request->input('idhebergement'),
        ]);
    }
}
