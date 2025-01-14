<?php

namespace App\Http\Controllers;

use App\Models\Categorievignoble;
use Auth;
use Illuminate\Http\Request;

class CategorieVignobleController extends Controller
{
    public function list()
    {
        if (!Auth::check() && Auth::user()->idrole != 2 )
            return redirect('/');
        return view('list-viticoles', ['viticoles' => Categorievignoble::all()]);
    }

    public function add(Request $request)
    {
        if (!Auth::check() && Auth::user()->idrole != 2 )
            return redirect('/');

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

        if (!Auth::check() && Auth::user()->idrole != 2 )
            return redirect('/');

        $categorie = Categorievignoble::find($idviticole);

        $categorie->delete();
        return back();
    }
}
