<?php

namespace App\Http\Controllers;

use App\Models\Adresse;
use Carbon\Carbon;
use DateInterval;
use \Datetime;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Hashing\BcryptHasher;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmail;
use App\Models\Client;
use Illuminate\Support\Str;

class ClientController extends Controller
{

    public function connexion()
    {
        if (!Auth::check())
            return view("client.connexion");
        return redirect('/client');
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
            'redirect' => ['string']
        ]);


        if (
            Auth::attempt([
                'emailclient' => $credentials['emailclientconnexion'],
                'password' => $credentials["motdepasseconnexion"]
            ])
        ) {
            $request->session()->regenerate();
            return redirect()->intended(isset($credentials['redirect'])
                ? $credentials['redirect']
                : '/client');
        }

        return response(back()->withErrors([
            'login' => 'L\'email ou le mot de passe est invalide.',
        ]));
    }

    public function signin(Request $request)
    {
        $credentials = $request->validate([
            'prenomclient' => ['required', "regex:/^[a-z \-']+$/i"],
            'nomclient' => ['required', "regex:/^[a-z \-']+$/i"],
            'emailclient' => ['required', 'email'],
            'telephoneclient' => ['required', 'regex:/^\d{10}$/'],
            'motdepasseclient' => ['required', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{12,}$/'],
            'offrespromotionnellesclient' => ['boolean'],
        ]);
        $datenaissanceclient = DateTime::createFromFormat(
            'j/n/Y',
            $request->request->get('journaissance') . "/" .
            $request->request->get('moisnaissance') . "/" .
            $request->request->get('anneenaissance')
        );


        return redirect('/client/adresse/ajouter')->withInput([
            'prenomclient' => $credentials['prenomclient'],
            'nomclient' => $credentials['nomclient'],
            'emailclient' => $credentials['emailclient'],
            'telephoneclient' => $credentials['telephoneclient'],
            'motdepasseclient' => $credentials['motdepasseclient'],
            'civiliteclient' => $request->request->get('civiliteclient'),
            'datenaissanceclient' => gettype($datenaissanceclient) == "boolean" ? null : $datenaissanceclient->format('j/n/Y'),
            'offrespromotionnellesclient' => $credentials['offrespromotionnellesclient'] ?? '0' === 'on',
            'redirect' => $credentials['redirect'] ?? null,
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }

    public function edit(Request $request)
    {
        // todo : l'edit marche plus ?????
        $credentials = $request->validate([
            'prenomclient' => ['required', "regex:/^[a-z \-']+$/i"],
            'nomclient' => ['required', "regex:/^[a-z \-']+$/i"],
            'emailclient' => ['required', 'email'],
            'numtelephoneclient' => ['required', 'regex:/^\d{10}$/'],
            'ancienmotdepasse' => ['required'],
        ]);

        $credentials["offrespromotionnellesclient"] = $request->input('offrespromotionnellesclient') == 'on';

        $datenaissanceclient = DateTime::createFromFormat(
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

            $user->prenomclient = ucfirst($credentials['prenomclient']);
            $user->nomclient = ucfirst($credentials['nomclient']);
            $user->emailclient = $credentials['emailclient'];
            $user->motdepasseclient = $credentials['password'];
            $user->offrespromotionnellesclient = $credentials['offrespromotionnellesclient'];
            $user->civiliteclient = $request->request->get('civiliteclient');
            $user->datenaissanceclient = gettype($datenaissanceclient) == "boolean" ? null : $datenaissanceclient;

            try {
                $user->update();
            } catch (QueryException $e) {
                return response(back()->withErrors(['datenaissanceclient' => "L'utilisateur doit etre majeur."]));
            }

            $request->session()->regenerate();
            return redirect()->back()->with('success', 'Les modifications ont bien été prises en compte.');
        } else
            return response(back()->withErrors([
                'ancienmotdepasse' => 'Le mot de passe est incorrect !',
            ]));

    }

    public function envoiemailmdp(Request $request)
    {
        $email = $request->input("email");
        $client = Client::where('emailclient', "=", $email)->first();

        if ($client != null) {
            $token = Str::random(60);

            $client->update([
                'tokenresetmdp' => $token,
                'datecreationtoken' => Carbon::now()
            ]);

            Mail::to($email)->send(new SendEmail([
                'type' => 'mdp',
                'prenom' => $client['prenomclient'],
                'nom' => $client['nomclient'],
                'civilite' => $client['civiliteclient'],
                'token' => $token
            ], "Reinitialisiation du mot de passe"));
        }

        return back()->with("password_success", "Si ce compte existe, vous recevrez un email afin de réinitialiser votre mot de passe.");
    }

    public function envoiSMS()
    {

    }
    public function resetPassword(Request $request, $token)
    {
        $client = Client::firstWhere('tokenresetmdp', "=", $token);
        if ($client != null) {
            if (Auth::check()) {
                Auth::logout();
            }
            return view("client.mdpreset", ['token' => $token]);
        }

        return redirect("/");


    }
    public function updatePassword(Request $request, $token)
    {
        $request->validate([
            'motdepasseclient' => ['required', 'string', 'min:12', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{12,}$/'],
            'confirmationmotdepasse' => ['required', 'same:motdepasseclient'],
        ]);


        $client = Client::firstWhere('tokenresetmdp', $token);

        if ($client) {
            $client->motdepasseclient = bcrypt($request->motdepasseclient);

            Client::where('idclient', $client['idclient'])
                ->update([
                    'tokenresetmdp' => null,
                    'datecreationtoken' => null,
                    'motdepasseclient' => $client->motdepasseclient
                ]);

            return redirect("/connexion");
        }

        return redirect("/");
    }

    public function createJsonFile($client)
    {
        $clientData = $client->toArray();
        $jsonData = json_encode($clientData, JSON_PRETTY_PRINT);
        $filename = 'client_' . $client->idclient . '_' . date('Y-m-d_H-i-s') . '.json';
        $path = storage_path('app/clients/');

        if (!file_exists($path)) {
            mkdir($path, 0755, true);
        }

        $filePath = $path . $filename;

        file_put_contents($filePath, $jsonData);

        return [
            'path' => $filePath,
            'name' => $filename
        ];
    }

    public function sendclientdata(Request $request, $idclient)
    {
        try {
            $client = Client::firstWhere("idclient", $idclient);

            $fileInfo = $this->createJsonFile($client);

            Mail::to($client->emailclient)
                ->send(new SendEmail([
                    'type' => 'data',
                    'prenom' => $client['prenomclient'],
                    'nom' => $client['nomclient'],
                    'civilite' => $client['civiliteclient'],
                    'attachment' => [
                        'path' => $fileInfo['path'],
                        'name' => $fileInfo['name']
                    ]
                ], "Vinotrip informations personnelles"));

            if (file_exists($fileInfo['path'])) {
                unlink($fileInfo['path']);
            }

            return redirect()->back()->with("successhotel", "le mail a été envoyé");
        } catch (\Exception $e) {
            if (isset($fileInfo) && file_exists($fileInfo['path'])) {
                unlink($fileInfo['path']);
            }

            throw $e;
        }
    }
}
