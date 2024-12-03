<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ClientController extends Controller
{

    public function authentification()
    {
        if (!Auth::check())
            return view ("authentification");
        return view("profile");
    }


    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function authenticate(Request $request)
    {

        $credentials = $request->validate([
            'emailclient' => ['required','email'],
            'motdepasseclient' => ['required'],
        ]);

        unset($credentials["motdepasseclient"]);
        $credentials["password"] = $request->motdepasseclient;


        if (Auth::attempt($credentials,)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return response(back()->withErrors([
            'email' => 'Mauvais identifiant ou mot de passe.',
        ]));
    }

    public function disconnect(Request $request)
    {
        Auth::logout();
        return redirect()->intended('/');
    }
}
