<?php

namespace App\Http\Controllers;

use App\Models\Adresse;
use Auth;
use Illuminate\Http\Request;

class AdresseController extends Controller
{
    public function adresses()
    {
        if (!Auth::check())
            return redirect('/connexion');
        return view("client.adresse.adresses", ["adresses" => Adresse::orderBy('idadresse')->where('idclient', '=', Auth::user()->idclient)->get()]);
    }

    public function modifier($id)
    {
        if (!Auth::check())
            return redirect('/connexion');
        return view("client.adresse.modifier", ["adresse" => Adresse::find($id)]);
    }

    public function supprimer($id)
    {
        if (!Auth::check())
            return redirect('/connexion');
        return view("client.adresse.supprimer", ["adresse" => Adresse::find($id)]);
    }

    public function ajouter()
    {
        if (!Auth::check())
            return redirect('/connexion');
        return view("client.adresse.ajouter");
    }

    public function edit(Request $request)
    {
        $credentials = $request->validate([
            'idadresse' => ['required'],
            'nomadresse' => ['required'],
            'nomdestinataireadresse' => ['required', "regex:/^[a-z \-']+$/i"],
            'prenomdestinataireadresse' => ['required', "regex:/^[a-z \-']+$/i"],
            'rueadresse' => ['required'],
            'villeadresse' => ['required', "regex:/^[a-z \-']+$/i"],
            'cpadresse' => ['required', "regex:/^\d{5}$/"],
            'paysadresse' => ['required', "regex:/^[a-z \-']+$/i"],
        ]);



        $adresse = Adresse::find($credentials['idadresse']);

        $adresse->nomadresse = ucfirst($credentials['nomadresse']);
        $adresse->nomdestinataireadresse = ucfirst($credentials['nomdestinataireadresse']);
        $adresse->prenomdestinataireadresse = ucfirst($credentials['prenomdestinataireadresse']);
        $adresse->rueadresse = ucfirst($credentials['rueadresse']);
        $adresse->cpadresse = $credentials['cpadresse'];
        $adresse->villeadresse = $credentials['villeadresse'];
        $adresse->paysadresse = ucfirst($credentials['paysadresse']);

        $adresse->update();

        $request->session()->regenerate();
        return redirect()->back()->with('success', 'Les modifications ont bien été prises en compte.');

    }

    public function add(Request $request)
    {
        $credentials = $request->validate([
            'nomadresse' => ['required'],
            'nomdestinataireadresse' => ['required', "regex:/^[a-z \-']+$/i"],
            'prenomdestinataireadresse' => ['required', "regex:/^[a-z \-']+$/i"],
            'rueadresse' => ['required'],
            'villeadresse' => ['required', "regex:/^[a-z \-']+$/i"],
            'cpadresse' => ['required', "regex:/^\d{5}$/"],
            'paysadresse' => ['required', "regex:/^[a-z \-']+$/i"],
        ]);



        $adresse = new Adresse();

        $adresse->idclient = Auth::user()->idclient;
        $adresse->nomadresse = ucfirst($credentials['nomadresse']);
        $adresse->nomdestinataireadresse = ucfirst($credentials['nomdestinataireadresse']);
        $adresse->prenomdestinataireadresse = ucfirst($credentials['prenomdestinataireadresse']);
        $adresse->rueadresse = ucfirst($credentials['rueadresse']);
        $adresse->cpadresse = $credentials['cpadresse'];
        $adresse->villeadresse = $credentials['villeadresse'];
        $adresse->paysadresse = ucfirst($credentials['paysadresse']);
        $adresse->save();

        return redirect('/client/adresses');

    }
}
