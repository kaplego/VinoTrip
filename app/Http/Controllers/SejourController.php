<?php

namespace App\Http\Controllers;

use App\Models\Categorieparticipant;
use App\Models\Categoriesejour;
use App\Models\Categorievignoble;
use App\Models\Sejour;
use App\Models\Destination;


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
            'destination' => Destination::all(),
        ]);
    }
}
