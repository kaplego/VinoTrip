<?php

namespace App\Http\Controllers;

use App\Models\Favoris;
use Auth;
use DB;
use Illuminate\Http\Request;

class FavorisController extends Controller
{
    public function list()
    {
        if (!Auth::check())
            return view("client.connexion");
        return view('client.favoris', ['favoris' => Auth::user()->favoris]);
    }

    public function delete(Request $request)
    {
        $favori = Favoris::where('idclient', '=', Auth::user()->idclient)
            ->where('idsejour', '=', $request->request->get('idsejour'))
            ->delete();
        return back();
    }

    public function add(Request $request)
    {
        $idclient = Auth::user()->idclient;
        DB::insert("
        insert into favoris(idclient, idsejour)
        values({$idclient}, {$request->request->get('idsejour')});
        ");

        return back();
    }
}
