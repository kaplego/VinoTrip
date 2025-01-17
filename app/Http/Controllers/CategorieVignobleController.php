<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use App\Helpers\Role;
use App\Models\Categorievignoble;
use Auth;
use Illuminate\Http\Request;

class CategorieVignobleController extends Controller
{
    public function list()
    {
        if (!Auth::check() && Helpers::AuthIsRole(Role::ServiceVente))
            return to_route('welcome');

        return view('list-viticoles', ['viticoles' => Categorievignoble::all()]);
    }

    public function add(Request $request)
    {
        if (!Auth::check() && Helpers::AuthIsRole(Role::ServiceVente))
            return to_route('welcome');

        $credentials = $request->validate([
            'libellecategorievignbole' => ['required'],
        ]);

        $categorie = new Categorievignoble();

        $categorie->libellecategorievignoble = $credentials['libellecategorievignbole'];
        $categorie->save();

        return back();
    }

    public function delete($idviticole)
    {

        if (!Auth::check() && Helpers::AuthIsRole(Role::ServiceVente))
            return to_route('welcome');

        $categorie = Categorievignoble::find($idviticole);

        $categorie->delete();
        return back();
    }
}
