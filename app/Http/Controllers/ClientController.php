<?php

namespace App\Http\Controllers;

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
        $credentials = $request->validate([
            'prenomclient'=> ['required'],
            'nomclient'=> ['required'],
            'emailclient' => ['required', 'email'],
            'motdepasseclient' => ['required'],
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->intended('/');
    }
}
