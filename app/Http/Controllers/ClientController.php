<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use App\Models\Adresse;
use Carbon\Carbon;
use DateInterval;
use \Datetime;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmail;
use App\Models\Client;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Verification\SMS;

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
            'civiliteclient' => ['nullable', 'in:M,Mme'],
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
        $credentials = $request->validate([
            'civiliteclient' => ['nullable', 'in:M,Mme'],
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

    public function createPdfFile($client)
    {
        $filename = 'client_' . $client->idclient . '_' . date('Y-m-d_H-i-s') . '.pdf';
        $path = storage_path('app/clients/');

        if (!file_exists($path)) {
            mkdir($path, 0755, true);
        }

        $html = '<h2 style="text-align:center">Informations clients</h2>';
        $html .= '<div style="font-size: 14px; line-height: 1.6">';

        $data = [
            'Nom' => $client->nomclient,
            'Prénom' => $client->prenomclient,
            'Email' => $client->emailclient,
            'Téléphone' => $client->telephoneclient,
            'Date de Naissance' => $client->datenaissanceclient,
        ];

        foreach ($data as $label => $value) {
            $html .= "<p><strong>$label:</strong> $value</p>";
        }

        $html .= '<h3>Adresses : </h3>';
        foreach ($client->adresses as $address) {
            $html .= "<p><strong>{$address->nomadresse}</strong><br>
            {$address->prenomadressedestinataire} {$address->nomadressedestinataire}<br>
            {$address->rueadresse}<br>
            {$address->cpadresse} {$address->villeadresse}<br>
            {$address->paysadresse}</p>";
        }

        $html .= '</div>';

        $pdf = PDF::loadHTML($html);
        $filePath = $path . $filename;
        $pdf->save($filePath);

        return [
            'path' => $filePath,
            'name' => $filename
        ];
    }

    public function sendclientdata(Request $request, $idclient)
    {
        try {
            $client = Client::firstWhere("idclient", $idclient);

            $fileInfo = $this->createPdfFile($client);

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

    public function securite()
    {
        if (!Auth::check())
            return redirect('/connexion');
        return view("client.securite");
    }

    public function a2fstart(Request $request)
    {
        $user = Auth::user();
        if (!$user)
            return response([
                'ok' => false
            ]);

        // $phone = Helpers::ClientPhone($user);
        $phone = '+33772241781';

        $verif = SMS::start($phone);

        session()->put('a2f-sms', $verif->sid);

        return response([
            'ok' => true,
            'status' => $verif->status
        ], 200, [
            'Content-Type' => 'application/json'
        ]);
    }

    public function a2fget(Request $request)
    {
        $user = Auth::user();
        $sid = session('a2f-sms');

        if (!$user || !$sid)
            return response([
                'ok' => false
            ]);

        try {
            $verif = SMS::get($sid);

            return response([
                'ok' => true,
                'status' => $verif->status
            ]);
        } catch (\Exception $e) {
            return response([
                'ok' => false
            ]);
        }
    }

    public function a2fcheck(Request $request)
    {
        $user = Auth::user();
        if (!$user || !$request->input('code'))
            return response([
                'ok' => false
            ]);

        // $phone = Helpers::ClientPhone($user);
        $phone = '+33772241781';

        $status = SMS::check($phone, $request->input('code'));

        if ($status === 'approved') {
            $a2f = !Auth::user()->a2f;

            Client::find(Auth::user()->idclient)->update([
                'a2f' => $a2f
            ]);

            session()->remove('a2f-sms');

            return response([
                'ok' => true,
                'status' => 'enabled' | 'disabled'
            ]);
        } else
            switch ($status) {
                case 'pending':
                        $error = "Le code est incorrect.";
                    break;
                case 'canceled':
                        $error = "La vérification a été annulée.";
                    break;
                case 'max_attempts_reached':
                        $error = "Vous avez atteint le nombre maximal d'essais.";
                    break;
                case 'deleted':
                        $error = "La vérification a été supprimée.";
                    break;
                case 'failed':
                        $error = "La vérification a échoué.";
                    break;
                case 'expired':
                        $error = "La vérification a expiré.";
                    break;
                default:
                        $error = "Une erreur s'est produite.";
                    break;
            }
            return response([
                'ok' => false,
                'error' => $error
            ]);
    }

    public function a2fcancel(Request $request)
    {
        $user = Auth::user();
        $sid = session('a2f-sms');

        if (!$user || !$sid)
            return response([
                'ok' => false
            ]);

        try {
            $verif = SMS::cancel($sid);

            session()->remove('a2f-sms');

            return response([
                'ok' => true,
                'status' => $verif->status
            ]);
        } catch (\Exception $e) {
            return response([
                'ok' => false
            ]);
        }
    }

    public function supprimerInformations($id)
    {
        $client = Client::find($id);


        $client->nomclient = "null";
        $client->prenomclient = "null";
        $client->telephoneclient = "0000000000";
        $client->civiliteclient = null;
        $client->offrespromotionnellesclient = false;
        $client->datenaissanceclient = null;

        $client->save();

        foreach ($client->adresses as $address) {
            $address->delete();
        }

        return redirect()->back()->with('success', 'Les modifications ont bien été prises en compte.');

    }



    public function anonymiser($idclient)
    {
        $client = Client::findOrFail($idclient);


        $client->update([
            'nomclient' => 'Anonyme',
            'prenomclient' => 'Anonyme',
            'telephoneclient' => '0000000000',
            'datenaissanceclient' => null,
            'civiliteclient' => null,
            'offrespromotionnellesclient' => false,
        ]);

        foreach ($client->adresses as $address) {
            $address->nomadresse = 'Anonyme';
            $address->prenomadressedestinataire = 'Anonyme';
            $address->nomadressedestinataire = 'Anonyme';
            $address->rueadresse = 'Anonyme';
            $address->cpadresse = '00000';
            $address->villeadresse = 'Anonyme';
            $address->paysadresse = 'Anonyme';
            $address->save();
        }

        return redirect()->back()->with('success', 'Les modifications ont bien été prises en compte.');
    }

}
