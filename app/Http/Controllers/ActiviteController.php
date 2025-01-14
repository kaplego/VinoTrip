<?php

namespace App\Http\Controllers;

use App\Models\Activite;
use App\Models\Appartient_4;
use App\Models\Etape;
use DB;
use Illuminate\Http\Request;
use App\Helpers\Helpers;
use App\Helpers\Role;

class ActiviteController extends Controller
{
    public function add(Request $request, $idsejour, $idetape)
    {
        if (!Helpers::AuthIsRole(Role::ServiceVente) && !Helpers::AuthIsRole(Role::Dirigeant))
            return redirect("/");

        $credentials = $request->validate([
            'activite-nom' => ['required'],
            'activite-prix' => ['required'],
        ]);

        $activite = new Activite();
        $activite->libelleactivite = $credentials['activite-nom'];
        $activite->prixactivite = $credentials['activite-prix'];
        $activite->save();

        DB::insert("
        insert into appartient_4(idetape, idactivite)
        values($idetape, $activite->idactivite);
        ");

        return back();
    }

    public function delete(Request $request, $idsejour, $idetape, $idactivite)
    {
        if (!Helpers::AuthIsRole(Role::ServiceVente) && !Helpers::AuthIsRole(Role::Dirigeant))
            return redirect("/");

        Appartient_4::where('idactivite', '=', $idactivite)
            ->where('idetape', '=', $idetape)
            ->delete();
        return back();
    }
}
