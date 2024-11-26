<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use Illuminate\Http\Request;

class CommandeController extends Controller
{
    public function list()
    {
        return view('commandes-list', ['commandes' => Commande::all() ]);
    }
}
