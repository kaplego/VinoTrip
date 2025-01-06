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

class ReservationHotelController extends Controller
{
    public function listReservation()
    {
        if(Auth::check() &&Auth::user()->idrole == 3)
        {
            return view('reservation/reservation-hotel', [

                'commandes' => VCommande::orderBy('idcommande')->get(),
                'descriptioncommande' => VDescriptioncommande::all(),
                'client'=>Client::all(),
                'sejour'=>Sejour::all(),
                'etape'=>Etape::all(),
                'hebergement'=>Hebergement::all(),

            ]);
        }
        else{

            return redirect("https://www.youtube.com/watch?v=dQw4w9WgXcQ");
        }

    }
    public function envoiemailhotel(Request $request){
        // if(isset($_POST["message"])){
        //     $message = "Ce message via la page contact du portfolio
        //     Nom : ". $_POST["nom"]."
        //     Email : ". $_POST["email"]."
        //     Message : ". $_POST["message"];

        $date = $request->input("datedebut");
        $nom= $request->input("nom");
        // }

        // $iddescrcommande= $request->input("unedescription");
        // $descrcommande = Descriptioncommande::find( $iddescrcommande);
        // $descrcommande->disponibilitehebergement = true;
        // $descrcommande->update();
        Mail::to("ppartenairehotel@gmail.com")->send(new SendEmail([
            'type' => 'hotel',
            'date' => $date,
            'nom' => $nom
        ],"Vinotrip validation de votre disponibilité "));

        return redirect()->back()->with("successhotel","le mail a été envoyé");
    }

    public function hebergementok(Request $request){
        $iddescrcommande= $request->input("unedescription");
        $descrcommande = Descriptioncommande::find( $iddescrcommande);
        $descrcommande->update([
            'disponibilitehebergement' => true
        ]);

        return redirect()->back()->with("successhotel","le mail a été envoyé");
    }

    public function clientok(Request $request){
        $iddescrcommande= $request->input("unedescription");
        $descrcommande = Descriptioncommande::find( $iddescrcommande);
        $descrcommande->update([
            'validationclient' => true
        ]);

        return redirect()->back()->with("successhotel","le mail a été envoyé");

    }

    public function clientnon(Request $request){
        $idcommande= $request->input("unecommande");
        $commande = Commande::find( $idcommande);
        $commande->update([
            'etatcommande' => "Annulé"
        ]);

        return redirect()->back()->with("successhotel","le mail a été envoyé");
    }

    public function envoiemailclient(Request $request){
        // if(isset($_POST["message"])){
        //     $message = "Ce message via la page contact du portfolio
        //     Nom : ". $_POST["nom"]."
        //     Email : ". $_POST["email"]."
        //     Message : ". $_POST["message"];

        //$mail = $request->input("emailpartenaire");
        // }
        $date = $request->input("datedebut");
        $titresejour= $request->input("titre");
        $prixsej= $request->input("prix");
        $idcommande= $request->input("unecommande");

        Mail::to("ppartenairehotel@gmail.com")->send(new SendEmail([
            'type' => 'client',
            'date' => $date,
            'titre' => $titresejour,
            'prix'=> $prixsej
        ], "confirmation validation du séjours vinotrip"));

        return redirect()->back()->with("successclient","le mail a été envoyé");
    }

    public function envoiemailValidationHebergement(Request $request){
        $iddescrcommande= $request->input("unedescription");
        $descrcommande = VDescriptioncommande::find( $iddescrcommande);
        $idclient= $request->input("unclient");

        $unclient = Client::find( $idclient);

        Mail::to("ppartenairehotel@gmail.com")->send(new SendEmail([
            'type' => 'ValidationHebegement',
            'nom' =>$unclient->nomclient,
            'prenom' =>$unclient->prenomclient,
            'datedebut'=>$descrcommande->datedebut,
            'datefin'=>$descrcommande->datefin,
            'nbadultes'=>$descrcommande->nbadultes,
            'nbenfants'=>$descrcommande->nbadultes,
            'nbenfant'=>$descrcommande->nbenfants,
            'nbchambressimple'=>$descrcommande->nbchambressimple,
            'nbchambresdouble'=>$descrcommande->nbchambresdouble,
            'nbchambrestriple'=>$descrcommande->nbchambrestriple,

        ], "Vinotrip validation hébergement"));

        return redirect()->back()->with("successclient","le mail a été envoyé");
    }

    public function envoieFinalClient(Request $request){
        $iddescrcommande= $request->input("unedescription");
        $descrcommande = VDescriptioncommande::find( $iddescrcommande);

        $idclient= $request->input("unclient");
        $unclient = Client::find( $idclient);
        // dd($descrcommande->repas);


        Mail::to("ppartenairehotel@gmail.com")->send(new SendEmail([
            'type' => 'ValidationClient',
            'nom' =>$unclient->nomclient,
            'prenom' =>$descrcommande->prenomclient,
            'datedebut'=>$descrcommande->datedebut,
            'datefin'=>$descrcommande->datefin,
            'nbadultes'=>$descrcommande->nbadultes,
            'nbenfants'=>$descrcommande->nbadultes,
            'nbenfant'=>$descrcommande->nbenfants,
            'jours'=>$descrcommande->sejour->duree->libelleduree,
            'titre'=>$descrcommande->sejour->titresejour,
            'titreheberg'=>$descrcommande->hebergement->hotel->nompartenaire,
            'repas'=>$descrcommande->repas


        ], "Vinotrip validation de votre séjours ! "));

        return redirect()->back()->with("successclient","le mail a été envoyé");
    }

    public function Restaurant(Request $request){
        $iddescrcommande= $request->input("unedescription");
        $descrcommande = VDescriptioncommande::find( $iddescrcommande);
        $idclient= $request->input("unclient");
        $unclient = Client::find( $idclient);


        Mail::to("ppartenairehotel@gmail.com")->send(new SendEmail([
            'type' => 'ReservationRestaurant',
            'nom' =>$unclient->nomclient,
            'prenom' =>$unclient->prenomclient,
            'datedebut'=>$descrcommande->datedebut,
            'datefin'=>$descrcommande->datefin,
            'nbadultes'=>$descrcommande->nbadultes,
            'nbenfants'=>$descrcommande->nbadultes,
            'nbenfant'=>$descrcommande->nbenfants,

        ], "Réservation restaurant "));

        return redirect()->back()->with("successclient","le mail a été envoyé");
    }
    public  function confirmationCommande(Request $request){
        $this->envoiemailValidationHebergement($request);
        $this->envoieFinalClient($request);
        $this->Restaurant($request);
        return redirect()->back()->with("successclient","le mail a été envoyé");
     }

}
