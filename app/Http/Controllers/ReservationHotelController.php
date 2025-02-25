<?php

namespace App\Http\Controllers;

use App\Mail\SendEmailType;
use App\Models\Client;
use App\Models\Commande;
use App\Models\Descriptioncommande;
use App\Models\VCommande;
use App\Models\VDescriptioncommande;
use App\Models\Etape;
use App\Models\Hebergement;
use App\Models\Restaurant;
use App\Models\Sejour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmail;
use App\Helpers\Helpers;
use App\Helpers\Role;

class ReservationHotelController extends Controller
{
    public function listReservation(Request $request)
    {
        if (!Helpers::AuthIsRole(Role::ServiceVente))
            return to_route('login')->withInput(['redirect' => $request->path()]);

        return view('reservation.reservation-hotel', [
            'commandes' => VCommande::orderBy('idcommande')->get(),
            'descriptioncommande' => VDescriptioncommande::all(),
            'client' => Client::all(),
            'sejour' => Sejour::all(),
            'etape' => Etape::all(),
            'hebergement' => Hebergement::all(),
        ]);
    }

    public function envoiemailhotel(Request $request)
    {
        if (!Helpers::AuthIsRole(Role::ServiceVente))
            return to_route('login')->withInput(['redirect' => $request->path()]);

        $date = $request->input("datedebut");
        $nom = $request->input("nom");

        Mail::to("ppartenairehotel@gmail.com")->send(new SendEmail([
            'type' => 'hotel',
            'date' => $date,
            'nom' => $nom
        ], "Vinotrip validation de votre disponibilité "));

        return back()->with("successhotel", "le mail a été envoyé");
    }

    public function hebergementok(Request $request)
    {
        if (!Helpers::AuthIsRole(Role::ServiceVente))
            return to_route('login')->withInput(['redirect' => $request->path()]);

        $iddescrcommande = $request->input("unedescription");
        $descrcommande = Descriptioncommande::find($iddescrcommande);
        $descrcommande->update([
            'disponibilitehebergement' => true
        ]);

        return back()->with("successhotel", "le mail a été envoyé");
    }

    public function clientok(Request $request)
    {
        if (!Helpers::AuthIsRole(Role::ServiceVente))
            return to_route('login')->withInput(['redirect' => $request->path()]);

        $iddescrcommande = $request->input("unedescription");
        $descrcommande = Descriptioncommande::find($iddescrcommande);
        $descrcommande->update([
            'validationclient' => true
        ]);

        return back()->with("successhotel", "le mail a été envoyé");
    }

    public function clientnon(Request $request)
    {
        if (!Helpers::AuthIsRole(Role::ServiceVente))
            return to_route('login')->withInput(['redirect' => $request->path()]);

        $idcommande = $request->input("unecommande");
        $commande = Commande::find($idcommande);
        $commande->update([
            'etatcommande' => "Annulé"
        ]);

        return redirect()->back()->with("successhotel", "le mail a été envoyé");
    }

    public function envoiemailclient(Request $request)
    {
        if (!Helpers::AuthIsRole(Role::ServiceVente))
            return to_route('login')->withInput(['redirect' => $request->path()]);

        $date = $request->input("datedebut");
        $titresejour = $request->input("titre");
        $prixsej = $request->input("prix");
        $idcommande = $request->input("unecommande");

        Mail::to("ppartenairehotel@gmail.com")->send(new SendEmail([
            'type' => 'client',
            'date' => $date,
            'titre' => $titresejour,
            'prix' => $prixsej
        ], "confirmation validation du séjours vinotrip"));

        return back()->with("successclient", "le mail a été envoyé");
    }

    public function envoiemailValidationHebergement($idclient, $iddescriptioncommande)
    {
        $descrcommande = VDescriptioncommande::find($iddescriptioncommande);

        $unclient = Client::find($idclient);

        Mail::to("ppartenairehotel@gmail.com")->send(new SendEmail([
            'type' => 'ValidationHebegement',
            'nom' => $unclient->nomclient,
            'prenom' => $unclient->prenomclient,
            'datedebut' => $descrcommande->datedebut,
            'datefin' => $descrcommande->datefin,
            'nbadultes' => $descrcommande->nbadultes,
            'nbenfants' => $descrcommande->nbadultes,
            'nbenfant' => $descrcommande->nbenfants,
            'nbchambressimple' => $descrcommande->nbchambressimple,
            'nbchambresdouble' => $descrcommande->nbchambresdouble,
            'nbchambrestriple' => $descrcommande->nbchambrestriple,

        ], "Vinotrip validation hébergement"));
    }

    public function envoieFinalClient($idclient, $iddescriptioncommande)
    {
        $descrcommande = VDescriptioncommande::find($iddescriptioncommande);
        $unclient = Client::find($idclient);

        Mail::to("ppartenairehotel@gmail.com")->send(new SendEmail([
            'type' => 'ValidationClient',
            'nom' => $unclient->nomclient,
            'prenom' => $descrcommande->prenomclient,
            'datedebut' => $descrcommande->datedebut,
            'datefin' => $descrcommande->datefin,
            'nbadultes' => $descrcommande->nbadultes,
            'nbenfants' => $descrcommande->nbadultes,
            'nbenfant' => $descrcommande->nbenfants,
            'jours' => $descrcommande->sejour->duree->libelleduree,
            'titre' => $descrcommande->sejour->titresejour,
            'titreheberg' => $descrcommande->hebergement->hotel->nompartenaire,
            'repas' => $descrcommande->repas


        ], "Vinotrip validation de votre séjours ! "));
    }

    public function Restaurant($idclient, $iddescriptioncommande)
    {
        $descrcommande = VDescriptioncommande::find($iddescriptioncommande);
        $unclient = Client::find($idclient);

        Mail::to("ppartenairehotel@gmail.com")->send(new SendEmail([
            'type' => 'ReservationRestaurant',
            'nom' => $unclient->nomclient,
            'prenom' => $unclient->prenomclient,
            'datedebut' => $descrcommande->datedebut,
            'datefin' => $descrcommande->datefin,
            'nbadultes' => $descrcommande->nbadultes,
            'nbenfants' => $descrcommande->nbadultes,
            'nbenfant' => $descrcommande->nbenfants,

        ], "Réservation restaurant "));
    }
    public function confirmationCommande(Request $request, $idclient, $iddescriptioncommande)
    {
        if (!Helpers::AuthIsRole(Role::ServiceVente))
            return to_route('login')->withInput(['redirect' => $request->path()]);

        $this->envoiemailValidationHebergement($idclient, $iddescriptioncommande);
        $this->envoieFinalClient($idclient, $iddescriptioncommande);
        $this->Restaurant($idclient, $iddescriptioncommande);
        return back()->with("successclient", "le mail a été envoyé");
    }

}
