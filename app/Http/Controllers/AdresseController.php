<?php

namespace App\Http\Controllers;

use App\Models\Adresse;
use App\Models\User;
use Auth;
use \Datetime;
use Http;
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

    public function ajouter(Request $request)
    {
        // dd($request);
        $data = $request->old() ?? $request->input();
        if (!Auth::check() && !$data['prenomclient'])
            return redirect('/connexion');

        return view("client.adresse.ajouter", $data);

    }

    public function edit(Request $request, $idadresse)
    {
        $credentials = $request->validate([
            'nomadresse' => ['required'],
            'nomadressedestinataire' => ['required', "regex:/^\D+$/i"],
            'prenomadressedestinataire' => ['required', "regex:/^\D+$/i"],
            'rueadresse' => ['required'],
            'villeadresse' => ['required', "regex:/^\D+$/i"],
            'cpadresse' => ['required', "regex:/^[a-zA-Z0-9 ]+$/"],
            'numadresse' => ['required', "regex:/^\d{1,6}$/"],
            'paysadresse' => ['required', "regex:/^\D+$/i"],
        ]);

        $adresse = Adresse::find($idadresse);

        if (!$adresse) return back();

        $adresse->nomadresse = ucfirst($credentials['nomadresse']);
        $adresse->nomadressedestinataire = ucfirst($credentials['nomadressedestinataire']);
        $adresse->prenomadressedestinataire = ucfirst($credentials['prenomadressedestinataire']);
        $adresse->rueadresse = ucfirst($credentials['rueadresse']);
        $adresse->cpadresse = $credentials['cpadresse'];
        $adresse->numadresse = $credentials['numadresse'];
        $adresse->villeadresse = $credentials['villeadresse'];
        $adresse->paysadresse = ucfirst($credentials['paysadresse']);

        $adresse->update();
        
        $request->session()->regenerate();

        return back()->with('success', 'Les modifications ont bien été prises en compte.');

    }

    public function add(Request $request)
    {
        $credentials = $request->validate([
            'nomadresse' => ['required'],
            'nomadressedestinataire' => ['required', "regex:/^\D+$/i"],
            'prenomadressedestinataire' => ['required', "regex:/^\D+$/i"],
            'rueadresse' => ['required'],
            'villeadresse' => ['required', "regex:/^\D+$/i"],
            'cpadresse' => ['required', "regex:/^[a-zA-Z0-9 ]+$/i"],
            'numadresse' => ['required', "regex:/^\d{1,6}$/"],
            'paysadresse' => ['required', "regex:/^\D+$/i"],
        ]);



        $adresse = new Adresse();

        $adresse->idclient = Auth::user()->idclient;
        $adresse->nomadresse = ucfirst($credentials['nomadresse']);
        $adresse->nomadressedestinataire = ucfirst($credentials['nomadressedestinataire']);
        $adresse->prenomadressedestinataire = ucfirst($credentials['prenomadressedestinataire']);
        $adresse->rueadresse = ucfirst($credentials['rueadresse']);
        $adresse->cpadresse = $credentials['cpadresse'];
        $adresse->villeadresse = $credentials['villeadresse'];
        $adresse->numadresse = $credentials['numadresse'];
        $adresse->paysadresse = ucfirst($credentials['paysadresse']);
        $adresse->save();
        return redirect('/client/adresses');

    }

    public function firstaddress(Request $request)
    {
        try {
            $credentials = $request->validate([
                'nomadresse' => ['required'],
                'nomadressedestinataire' => ['required', "regex:/^\D+$/i"],
                'prenomadressedestinataire' => ['required', "regex:/^\D+$/i"],
                'rueadresse' => ['required'],
                'villeadresse' => ['required', "regex:/^\D+$/i"],
                'cpadresse' => ['required', "regex:/^[a-zA-Z0-9 ]+$/i"],
                'numadresse' => ['required', "regex:/^\d{1,6}$/"],
                'paysadresse' => ['required', "regex:/^\D+$/i"],
            ]);
        } catch (\Exception $e) {

            //recupère toutes les données du nouveau client
            $values = [];
            foreach ($request->request->all() as $key => $value) {
                $values = array_merge($values, [$key => $value]);
            }

            //renvoie les valeurs et les erreurs correspondantes
            return response(redirect()->back()->withErrors(
                $e->validator->messages()->messages()
            )->withInput($values));
        }

        $password = bcrypt($request->request->get('motdepasseclient'));

        $user = new User();
        $user->prenomclient = ucfirst($request->request->get('prenomclient'));
        $user->nomclient = ucfirst($request->request->get('nomclient'));
        $user->emailclient = $request->request->get('emailclient');
        $user->motdepasseclient = $password;
        $user->offrespromotionnellesclient = $request->request->get('offrespromotionnellesclient') ?? '0';
        $user->civiliteclient = $request->request->get('civiliteclient');

        $datenaissance = DateTime::createFromFormat('j/n/Y', $request->request->get('datenaissanceclient'));
        $user->datenaissanceclient = is_bool($datenaissance) ? null : $datenaissance->format('n/j/Y');
        $user->telephoneclient = $request->request->get('numtelephoneclient') ?? '0102030405';
        $user->idrole = 1;
        $user->save();

        $adresse = new Adresse();

        $adresse->idclient = $user->idclient;
        $adresse->nomadresse = ucfirst($credentials['nomadresse']);
        $adresse->nomadressedestinataire = ucfirst($credentials['nomadressedestinataire']);
        $adresse->prenomadressedestinataire = ucfirst($credentials['prenomadressedestinataire']);
        $adresse->rueadresse = ucfirst($credentials['rueadresse']);
        $adresse->cpadresse = $credentials['cpadresse'];
        $adresse->numadresse = $credentials['numadresse'];
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

    public function geoapify(Request $request)
    {
        $text = $request->input('text');
        $type = $request->input('type');

        $response = Http::post("https://api.geoapify.com/v1/geocode/autocomplete?text=$text&apiKey=a6a920505a804fa39096deb61a2c10d6&type=$type&limit=5");

        return response($response->json());
    }
}
