<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use App\Models\Avis;
use App\Models\Sejour;
use App\Models\Reponse;
use Auth;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Validator;

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

    public function create(Request $request, $idsejour)
    {
        if (!Auth::check())
            return redirect("/sejour/$idsejour");

        $validator = Validator::make($request->all(), [
            'photo' => ['nullable', 'file', 'image', 'max:512'],
            'note' => ['required', 'numeric', 'between:1,5'],
            'titre' => ['required', 'between:5,50'],
            'description' => ['required', 'between:5,2048']
        ]);

        if ($validator->fails())
            return back()->withErrors([
                'avis' => $validator->errors()->first()
            ]);

        $avis = Avis::create([
            'idsejour' => $idsejour,
            'idclient' => Auth::user()->idclient,
            'dateavis' => Carbon::now(),
            'titreavis' => $request->input('titre'),
            'descriptionavis' => $request->input('description'),
            'noteavis' => $request->input('note')
        ]);

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = "avis$avis->idavis." . $file->extension();

            Helpers::Upload($file, $filename, 'avis');
            $avis->update([
                'photoavis' => $filename
            ]);
        }

        return redirect("/sejour/$idsejour");
    }

    public function reply(Request $request, $idsejour, $idavis)
    {
        if (!Auth::check()) {
            return redirect("/sejour/$idsejour");
        }

        $avis = Avis::find($idavis);

        if (!$avis)
            return redirect("/sejour/$idsejour");

        $request->validate([
            'reply' => ['required', 'between:5,2048']
        ]);

        $reply = Reponse::create([
            'idavis' => $avis->idavis,
            'descriptionreponse' => $request->input('reply'),
        ]);

        return redirect()->back()->with('success', 'Réponse publiée avec succès');
    }

}
