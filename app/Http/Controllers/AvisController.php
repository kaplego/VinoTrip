<?php

namespace App\Http\Controllers;

use App\Models\Sejour;
use DB;

class AvisController extends Controller
{
    public function list()
    {
        return view("avis-list", [
            'listeSejour' => Sejour::select(['sejour.*'])
                ->join('avis', 'sejour.idsejour', 'avis.idsejour')
                ->groupBy('sejour.idsejour')
                ->having(DB::raw('COUNT(avis)'), '>', 0)
                ->orderByDesc(DB::raw('COUNT(avis)'))
                ->get(),
        ]);
    }
}
