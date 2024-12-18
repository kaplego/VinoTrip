<?php

namespace App\Http\Controllers;

use App\Models\Avis;
use App\Models\Etape;
use App\Models\Sejour;
use Cookie;
use DB;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index()
    {
        return view("welcome", [
            'listeSejour' => Sejour::
                select(['sejour.*'])
                ->join('avis', 'sejour.idsejour', 'avis.idsejour')
                ->groupBy('sejour.idsejour')
                ->having(DB::raw('COUNT(avis)'), '>', 0)
                ->limit(5)
                ->get(),
        ]);
    }
    public function mentions()
    {
        return view("legal.mentions-legales");
    }
    public function politique()
    {
        return view("legal.politique");
    }
    public function contact()
    {
        return view("contact");
    }
    public function conditions()
    {
        return view("legal.conditions-vente");
    }
    public function destinations()
    {
        return view("destinations");
    }
    public function test()
    {
        return view("test");
    }

    public function dialogflow(Request $request)
    {
        switch ($request->input('queryResult')['action']) {
            case 'OffrirSejour.OffrirSejour-fallback':
                $sejours = Sejour::whereRaw(
                    'LOWER(titresejour) LIKE LOWER(?)',
                    ['%' . $request->input('queryResult')['queryText'] . '%']
                )->get();

                return response([
                    "fulfillmentMessages" => [
                        [
                            "payload" => [
                                "richContent" =>
                                    sizeof($sejours) === 0 ? [
                                        [
                                            [
                                                "type" => "description",
                                                "title" => "Je n'ai pas trouvé ce séjour.",
                                                "text" => [
                                                    "Cependant, voici les étapes pour offrir un séjour :",
                                                    "1. Choisissez un séjour avec le lien ci-dessous.",
                                                    "2. Cliquez sur le bouton \"Personnaliser ou offrir\"",
                                                    "3. Remplissez les informations nécéssaires (dates, hébergement, ...)",
                                                    "4. Cochez la case portant le libellé \"Offrir\"",
                                                    "5. Choisissez le format du coffret cadeau : électronique ou postal.",
                                                    "6. Ajoutez le séjour au panier.",
                                                    "7. Si par voie postale, au moment du paiement, choisissez l'adresse de livraion.",
                                                    "8. Terminez votre commande et récupérez votre code cadeau si nécéssaire dans votre compte client."
                                                ]
                                            ]
                                        ],
                                        [
                                            [
                                                "type" => "button",
                                                "icon" => [
                                                    "type" => "shopping_cart",
                                                    "color" => "var(--df-messenger-send-icon)"
                                                ],
                                                "text" => "Liste des séjours",
                                                "link" => "/sejours"
                                            ]
                                        ]
                                    ] : [
                                        [
                                            [
                                                "type" => "description",
                                                "title" => "J'ai trouvé " . sizeof($sejours) . " séjour(s).",
                                                "text" => [
                                                    "Voici les étapes pour offrir un séjour :",
                                                    "1. Cliquez sur un des séjours ci-dessous.",
                                                    "2. Remplissez les informations nécéssaires (dates, hébergement, ...)",
                                                    "3. Cochez la case portant le libellé \"Offrir\"",
                                                    "4. Choisissez le format du coffret cadeau : électronique ou postal.",
                                                    "5. Ajoutez le séjour au panier.",
                                                    "6. Si par voie postale, au moment du paiement, choisissez l'adresse de livraion.",
                                                    "7. Terminez votre commande et récupérez votre code cadeau si nécéssaire dans votre compte client."
                                                ]
                                            ]
                                        ],
                                        ...array_map(function ($sejour) {
                                            return [
                                                [
                                                    "type" => "button",
                                                    "icon" => [
                                                        "type" => "shopping_cart",
                                                        "color" => "var(--df-messenger-send-icon)"
                                                    ],
                                                    "text" => $sejour['titresejour'],
                                                    "link" => "/personnaliser/$sejour[idsejour]"
                                                ]
                                            ];
                                        }, $sejours->toArray())
                                    ]

                            ]
                        ]
                    ]
                ]);
            default:
                return response(null, 400);
        }
    }

}
