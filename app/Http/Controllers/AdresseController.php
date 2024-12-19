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
        dd(Session::All());
        if (!Auth::check() && Session::get("prenomclient") == null)
            return redirect('/connexion');

        return view("client.adresse.ajouter", Session::all());

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
            ]);
        }
        catch(\Exception $e){

            //recupère toutes les données du nouveau client
            $values = [];
            foreach ($request->request->all() as $key => $value) {
                $values = array_merge($values, [$key => $value]);
            }

            //renvoie les valeurs et les erreurs correspondantes
            return response(redirect()->back()->withErrors(
                $e->validator->messages()->messages())->with($values));
        }

        $password = bcrypt($request->request->get('motdepasseclient'));

        $user = new User();

        $user->prenomclient = ucfirst($request->request->get('prenomclient'));
        $user->nomclient = ucfirst($request->request->get('nomclient'));
        $user->emailclient = $request->request->get('emailclient');
        $user->motdepasseclient = $password;
        $user->offrespromotionnellesclient =$request->request->get('offrespromotionnellesclient')?? '0';
        $user->civiliteclient = $request->request->get('civiliteclient');
        $user->datenaissanceclient = $request->request->get('datenaissanceclient');
        $user->telephoneclient = $request->request->get('telephoneclient') ?? '0102030405';
        $user->idrole = 1;
        $user->save();

        $adresse = new Adresse();

        $adresse->idclient =  $user->idclient ;
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
                'emailclient' => $user->emailclient,
                'password' => $request->request->get('motdepasseclient')
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
