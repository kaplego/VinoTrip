<?php

namespace App\Http\Controllers;

use DateInterval;
use \Datetime;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Hashing\BcryptHasher;


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
        return view("client.compte");
    }

    public function informations()
    {
        if (!Auth::check())
            return redirect('/connexion');
        return view("client.informations");
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
            'emailclientconnexion' => ['required', 'email'],
            'motdepasseconnexion' => ['required'],
        ]);

        unset($credentials["motdepasseconnexion"]);
        $credentials["password"] = $request->motdepasseconnexion;

        unset($credentials["emailclientconnexion"]);
        $credentials["emailclient"] = $request->emailclientconnexion;


        if (Auth::attempt($credentials, )) {
            $request->session()->regenerate();
            return redirect()->intended('/profil');
        }

        return response(back()->withErrors([
            'login' => 'L\'email ou le mot de passe est invalide.',
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

        $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{12,}$/';

        if (preg_match($pattern, $request->motdepasseclient))
            $credentials["password"] = bcrypt($request->motdepasseclient);
        else
            return response(back()->withErrors([
                'motdepasseclient' => 'Format non valide',
            ]));


        $datenaissance = DateTime::createFromFormat(
            'j/n/Y',
            $request->request->get('journaissance') . "/" .
            $request->request->get('moisnaissance') . "/" .
            $request->request->get('anneenaissance')
        );


        $user = new User();

        $user->prenomclient = $credentials['prenomclient'];
        $user->nomclient = $credentials['nomclient'];
        $user->emailclient = $credentials['emailclient'];
        $user->motdepasseclient = $credentials['password'];
        $user->offrespromotionnellesclient = $credentials['offrespromotionnellesclient'];
        $user->civiliteclient = $request->request->get('civiliteclient');
        $user->datenaissanceclient = gettype($datenaissance) == "boolean" ? null : $datenaissance;

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

    public function edit(Request $request)
    {
        $credentials = $request->validate([
            'prenomclient' => ['required'],
            'nomclient' => ['required'],
            'emailclient' => ['required', 'email'],
            'ancienmotdepasse' => ['required'],
        ]);

        if ($request->request->get('offrespromotionnellesclient') != "on")
            $credentials["offrespromotionnellesclient"] = false;
        else
            $credentials["offrespromotionnellesclient"] = true;






        $datenaissance = DateTime::createFromFormat(
            'j/n/Y',
            $request->request->get('journaissance') . "/" .
            $request->request->get('moisnaissance') . "/" .
            $request->request->get('anneenaissance')
        );



        $user = User::find(Auth::user()->idclient);

        unset($credentials["password"]);
        $credentials["password"] = bcrypt($request->ancienmotdepasse);

        $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{12,}$/';
        if ($request->nouveaumotdepasse != null) {
            if (preg_match($pattern, $request->nouveaumotdepasse))
                if ($request->nouveaumotdepasse != $request->confirmationmotdepasse)
                    return response(back()->withErrors([
                        'confirmationmotdepasse' => 'Les mots de passe ne correspondent pas.',
                    ]));
                else {
                    unset($credentials["password"]);
                    $credentials["password"] = bcrypt($request->nouveaumotdepasse);
                } else
                return response(back()->withErrors([
                    'nouveaumotdepasse' => 'Format non valide',
                ]));
        }
        $hasher = app('hash');

        if ($hasher->check($request->ancienmotdepasse, $user->motdepasseclient)) {

            $user->prenomclient = $credentials['prenomclient'];
            $user->nomclient = $credentials['nomclient'];
            $user->emailclient = $credentials['emailclient'];
            $user->motdepasseclient = $credentials['password'];
            $user->offrespromotionnellesclient = $credentials['offrespromotionnellesclient'];
            $user->civiliteclient = $request->request->get('civiliteclient');
            $user->datenaissanceclient = gettype($datenaissance) == "boolean" ? null : $datenaissance;

            $user->update();

            $request->session()->regenerate();
            return redirect()->back()->with('success', 'Les modifications ont bien été prises en compte.');
        }
        else
            return response(back()->withErrors([
                'ancienmotdepasse' => 'Le mot de passe est incorrect !',
            ]));

    }
}
