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
use App\Models\Avis;


use App\Models\Visite;
use Illuminate\Http\Request;

class AvisController extends Controller
{
    public function list()
    {
        return view("avis-list");
    }
}