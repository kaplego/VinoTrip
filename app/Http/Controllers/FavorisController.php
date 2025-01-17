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
            return to_route('login');
        return view('client.favoris', ['favoris' => Auth::user()->favoris]);
    }

    public function delete(Request $request, $idsejour)
    {
        if (!Auth::check())
            return to_route('login')->withInput(['redirect' => route('favoris')]);

        Favoris::where('idclient', '=', Auth::user()->idclient)
            ->where('idsejour', '=', $idsejour)
            ->delete();
        return back();
    }

    public function add(Request $request, $idsejour)
    {
        $idclient = Auth::user()->idclient;
        DB::insert("
        insert into favoris(idclient, idsejour)
        values({$idclient}, {$idsejour});
        ");

        return back();
    }
}
