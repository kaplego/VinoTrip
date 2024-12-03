<?php

namespace App\Http\Controllers;

use App\Models\Categorieparticipant;
use App\Models\Categoriesejour;
use App\Models\Categorievignoble;
use App\Models\Duree;
use App\Models\Etape;
use App\Models\Hebergement;
use App\Models\Sejour;
use App\Models\Localite;


use App\Models\Visite;
use Illuminate\Http\Request;

class SejourController extends Controller
{
    public function list()
    {
        return view('sejours-list', [
            'sejours' => Sejour::all(),
            'categoriesejour' => Categoriesejour::all(),
            'categorieparticipant' => Categorieparticipant::all(),
            'categoriesvignoble' => Categorievignoble::all(),
            'localites' => Localite::all(),
            'durees' => Duree::all(),



        ]);
    }

    public function one($id)
    {
        return view ("sejour-summary", [
            'sejour'=>Sejour::find($id),
            'hebergement' => Hebergement::all(),
            'visite' => Visite::all(),

        ]);
    }



}
