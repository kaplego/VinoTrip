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

        $mail = $request->input("emailpartenaire");
        // }
        $message = $mail;

        Mail::to("ppartenairehotel@gmail.com")->send(new SendEmail($message,"Confirmation de votre reservation"));

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
        $message = "bonjour !";

        Mail::to("ppartenairehotel@gmail.com")->send(new SendEmail($message,"Confirmation de votre reservation"));

        return redirect()->back()->with("successclient","le mail a été envoyé");


    }







}
