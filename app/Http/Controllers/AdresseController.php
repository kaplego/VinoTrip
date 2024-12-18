<?php

namespace App\Http\Controllers;

use App\Models\Adresse;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Session;

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
        $ok = false;
        foreach (Auth::user()->adresses as $value) {
            if ($value->idadresse == $id) {
                $ok = true;
                break;
            }
        }
        if (!Auth::check() || !$ok)
            return redirect('/connexion');
        return view("client.adresse.modifier", ["adresse" => Adresse::find($id)]);
    }

    public function ajouter()
    {
        if (!Auth::check() && Session::get("prenomclient") == null)
            return redirect('/connexion');

        return view("client.adresse.ajouter", [
            'prenomclient' => Session::get("prenomclient"),
            'nomclient' => Session::get("nomclient"),
            'emailclient' => Session::get("emailclient"),
            'motdepasseclient' => Session::get("motdepasseclient"),
            'civiliteclient' => Session::get("civiliteclient"),
            'datenaissance' => Session::get("datenaissance"),
            'offrespromotionnellesclient' => Session::get("offrespromotionnellesclient"),
            'redirect' => Session::get("redirect"),
            ]);

    }

    public function edit(Request $request)
    {
        $credentials = $request->validate([
            'idadresse' => ['required'],
            'nomadresse' => ['required'],
            'nomadressedestinataire' => ['required', "regex:/^[a-z \-']+$/i"],
            'prenomadressedestinataire' => ['required', "regex:/^[a-z \-']+$/i"],
            'rueadresse' => ['required'],
            'villeadresse' => ['required', "regex:/^[a-z \-']+$/i"],
            'cpadresse' => ['required', "regex:/^\d{5}$/"],
            'paysadresse' => ['required', "regex:/^[a-z \-']+$/i"],
        ]);



        $adresse = Adresse::find($credentials['idadresse']);

        $adresse->nomadresse = ucfirst($credentials['nomadresse']);
        $adresse->nomadressedestinataire = ucfirst($credentials['nomadressedestinataire']);
        $adresse->prenomadressedestinataire = ucfirst($credentials['prenomadressedestinataire']);
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
            'nomadressedestinataire' => ['required', "regex:/^[a-z \-']+$/i"],
            'prenomadressedestinataire' => ['required', "regex:/^[a-z \-']+$/i"],
            'rueadresse' => ['required'],
            'villeadresse' => ['required', "regex:/^[a-z \-']+$/i"],
            'cpadresse' => ['required', "regex:/^\d{5}$/"],
            'paysadresse' => ['required', "regex:/^[a-z \-']+$/i"],
        ]);



        $adresse = new Adresse();

        $adresse->idclient = Auth::user()->idclient;
        $adresse->nomadresse = ucfirst($credentials['nomadresse']);
        $adresse->nomadressedestinataire = ucfirst($credentials['nomadressedestinataire']);
        $adresse->prenomadressedestinataire = ucfirst($credentials['prenomadressedestinataire']);
        $adresse->rueadresse = ucfirst($credentials['rueadresse']);
        $adresse->cpadresse = $credentials['cpadresse'];
        $adresse->villeadresse = $credentials['villeadresse'];
        $adresse->paysadresse = ucfirst($credentials['paysadresse']);
        $adresse->save();
        return redirect('/client/adresses');

    }

    public function firstaddress(Request $request)
    {
        try{
        $credentials = $request->validate([
            'nomadresse' => ['required'],
            'nomadressedestinataire' => ['required', "regex:/^[a-z \-']+$/i"],
            'prenomadressedestinataire' => ['required', "regex:/^[a-z \-']+$/i"],
            'rueadresse' => ['required'],
            'villeadresse' => ['required', "regex:/^[a-z \-']+$/i"],
            'cpadresse' => ['required', "regex:/^\d{5}$/"],
            'paysadresse' => ['required', "regex:/^[a-z \-']+$/i"],
            //rajouter les valeurs des cases du formulaire
        ]);
        }
        catch(\Exception $e){

        $errors = [];


        return response(back()->withErrors($e->validator->messages()->messages())->with(
            [
                'prenomclient' => $request->request->get('prenomclient'),
                'nomclient' => $request->request->get('nomclient'),
                'emailclient' => $request->request->get('emailclient'),
                'motdepasseclient' => $request->request->get('motdepasseclient'),
                'civiliteclient' => $request->request->get('civiliteclient'),
                'datenaissance' => $request->request->get('datenaissance'),
                'offrespromotionnellesclient' => $request->request->get('offrespromotionnellesclient'),
                'redirect' => $request->request->get('redirect'),
            ]
        ));
        }


        $password = bcrypt($credentials['motdepasseclient']);

        $user = new User();

        $user->prenomclient = ucfirst($credentials['prenomclient']);
        $user->nomclient = ucfirst($credentials['nomclient']);
        $user->emailclient = $credentials['emailclient'];
        $user->motdepasseclient = $password;
        $user->offrespromotionnellesclient = $credentials['offrespromotionnellesclient'] ?? '0' === 'on';
        $user->civiliteclient = $request->request->get('civiliteclient');
        $user->datenaissanceclient = $credentials['datenaissance'];
        $user->idrole = 1;
        $user->save();

        $adresse = new Adresse();

        $adresse->idclient =  $credentials['client']['idclient'] ;
        $adresse->nomadresse = ucfirst($credentials['nomadresse']);
        $adresse->nomadressedestinataire = ucfirst($credentials['nomadressedestinataire']);
        $adresse->prenomadressedestinataire = ucfirst($credentials['prenomadressedestinataire']);
        $adresse->rueadresse = ucfirst($credentials['rueadresse']);
        $adresse->cpadresse = $credentials['cpadresse'];
        $adresse->villeadresse = $credentials['villeadresse'];
        $adresse->paysadresse = ucfirst($credentials['paysadresse']);
        $adresse->save();

        if (
            Auth::attempt([
                'emailclient' => $credentials['client']['emailclient'],
                'password' => $credentials['client']['motdepasseclient']
            ])
        ) {
            $request->session()->regenerate();
            return redirect()->intended(isset($credentials['redirect'])
                ? $credentials['redirect']
                : '/client');
        }
        return redirect('/client/adresses');

    }

    public function delete(Request $request)
    {
        $adresse = Adresse::find($request->request->get('idadresse'));
        $adresse->delete();
        return redirect('/client/adresses');
    }
}
