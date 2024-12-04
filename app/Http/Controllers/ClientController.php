<?php

namespace App\Http\Controllers;

use DateInterval;
use \Datetime;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ClientController extends Controller
{

    public function connexion()
    {
        if (!Auth::check())
            return view("client.connexion");
        return redirect('/profil');
    }

    public function profil()
    {
        if (!Auth::check())
            return redirect('/connexion');
        return view("client.profil");
    }

    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {

        $credentials = $request->validate([
            'emailclient' => ['required', 'email'],
            'motdepasseclient' => ['required'],
        ]);

        unset($credentials["motdepasseclient"]);
        $credentials["password"] = $request->motdepasseclient;


        if (Auth::attempt($credentials, )) {
            $request->session()->regenerate();
            return redirect()->intended('/profil');
        }

        return response(back()->withErrors([
            'email' => 'Mauvais identifiant ou mot de passe.',
        ]));
    }

    public function signin(Request $request)
    {
        //dd($request);
        $credentials = $request->validate([
            'prenomclient' => ['required'],
            'nomclient' => ['required'],
            'emailclient' => ['required', 'email'],
            'motdepasseclient' => ['required'],
        ]);

        if ($request->request->get('offrespromotionnellesclient') != "on")
            $credentials["offrespromotionnellesclient"] = false;
        else
            $credentials["offrespromotionnellesclient"] = true;

        $credentials["password"] = bcrypt($request->motdepasseclient);

        $datenaissance = DateTime::createFromFormat('j/n/Y', $request->request->get('journaissance') . "/" . $request->request->get('moisnaissance') . "/" . $request->request->get('anneenaissance'));


        // VERIF AGE dd($datenaissance > date('j/n/Y')->sub(DateInterval::createFromDateString('18 years')));

        $user = new User();
        $user->prenomclient = $credentials['prenomclient'];
        $user->nomclient = $credentials['nomclient'];
        $user->emailclient = $credentials['emailclient'];
        $user->motdepasseclient = $credentials['password'];
        $user->offrespromotionnellesclient = $credentials['offrespromotionnellesclient'];
        $user->civiliteclient = $request->request->get('civiliteclient');
        //$user->remember_token = $request->request->get('_token');
        $user->datenaissanceclient = $datenaissance;
        $user->save();

        unset($credentials["motdepasseclient"]);
        $credentials["password"] = $request->motdepasseclient;

        if (Auth::attempt($credentials, )) {
            $request->session()->regenerate();
            return redirect()->intended('/profil');
        }

        return response(back()->withErrors([
            'email' => 'Mauvais identifiant ou mot de passe.',
        ]));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->intended('/');
    }
}
