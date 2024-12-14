<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Commande;
use App\Models\Descriptioncommande;
use App\Models\Etape;
use App\Models\Hebergement;
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

                'commandes' => Commande::all(),
                'descriptioncommande' => Descriptioncommande::all(),
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

        Mail::to("ppartenairehotel@gmail.com")->send(new SendEmail([
            'type' => 'hotel',
            'date' => $date,
            'nom' => $nom
        ],"Vinotrip validation de votre disponibilité "));

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

        Mail::to("ppartenairehotel@gmail.com")->send(new SendEmail([
            'type' => 'client',
            'date' => $date,
            'titre' => $titresejour,
            'prix'=> $prixsej

        ], "confirmation validation du séjours vinotrip"));

        return redirect()->back()->with("successclient","le mail a été envoyé");


    }

    public function envoiemailValidationHebergement(Request $request){

        $date = $request->input("datedebut");
        $titresejour= $request->input("titre");
        $prixsej= $request->input("prix");

        Mail::to("ppartenairehotel@gmail.com")->send(new SendEmail([
            'type' => 'ValidationHebegement',
            'date' => $date,
            'titre' => $titresejour,
            'prix'=> $prixsej

        ], "Vinotrip validation séjour"));

        return redirect()->back()->with("successclient","le mail a été envoyé");
    }

    public function envoieFinalClient(Request $request){
        $date = $request->input("datedebut");
        $titresejour= $request->input("titre");
        $prixsej= $request->input("prix");

        Mail::to("ppartenairehotel@gmail.com")->send(new SendEmail([
            'type' => 'ValidationClient',
            'date' => $date,
            'titre' => $titresejour,
            'prix'=> $prixsej

        ], "Vinotrip validation de votre séjours ! "));

        return redirect()->back()->with("successclient","le mail a été envoyé");
    }

    public function Restaurant(Request $request){
        $date = $request->input("datedebut");
        $titresejour= $request->input("titre");
        $prixsej= $request->input("prix");

        Mail::to("ppartenairehotel@gmail.com")->send(new SendEmail([
            'type' => 'ValidationClient',
            'date' => $date,
            'titre' => $titresejour,
            'prix'=> $prixsej

        ], "Réservation restaurant "));

        return redirect()->back()->with("successclient","le mail a été envoyé");
    }

    public function envoiemailIndisponiliteHebergement(Request $request){
        $date = $request->input("datedebut");
        $titresejour= $request->input("titre");
        $prixsej= $request->input("prix");

        Mail::to("ppartenairehotel@gmail.com")->send(new SendEmail([
            'type' => 'PbHeberg',
            'date' => $date,
            'titre' => $titresejour,
            'prix'=> $prixsej

        ], "Équipe vinotrip changement d'hebergement "));

        return redirect()->back()->with("successclient","le mail a été envoyé");
    }



}
