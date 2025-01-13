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
    public function add(Request $request)
    {
        if (!Helpers::AuthIsRole(Role::ServiceVente) && !Helpers::AuthIsRole(Role::Dirigeant))
            return redirect("/");

        $credentials = $request->validate([
            'activite-nom' => ['required'],
            'activite-prix' => ['required'],
            'activite-idetape' => ['required'],
        ]);

        $activite = new Activite();
        $activite->libelleactivite = $credentials['activite-nom'];
        $activite->prixactivite = $credentials['activite-prix'];
        $activite->save();

        DB::insert("
        insert into appartient_4(idetape, idactivite)
        values({$credentials['activite-idetape']}, $activite->idactivite);
        ");

        return back();
    }

    public function delete(Request $request)
    {
        if (!Helpers::AuthIsRole(Role::ServiceVente) && !Helpers::AuthIsRole(Role::Dirigeant))
            return redirect("/");

        $credentials = $request->validate([
            'delete-activite-idactivite' => ['required'],
            'delete-activite-idetape' => ['required'],
        ]);

        DB::insert("
        delete from appartient_4 where idactivite={$credentials['delete-activite-idactivite']} and idetape={$credentials['delete-activite-idetape']}
        ");
        return back();
    }
}
