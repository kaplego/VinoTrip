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
    public function envoiemail(Request $request){
        // if(isset($_POST["message"])){
        //     $message = "Ce message via la page contact du portfolio
        //     Nom : ". $_POST["nom"]."
        //     Email : ". $_POST["email"]."
        //     Message : ". $_POST["message"];

        $mail = $request->input("emailpartenaire");
        // }
        $retour = mail("titouan.barry@etu.univ-smb.fr", "test","je veux te parler mon reuf \n qsdqsdqsd",
        "From:".$mail."\r\nReply-to: test@mail.com" );
        dd($retour);
        if($retour){
            echo( "<p> The email has been sent successfully.<p>");
        }

    }






}
