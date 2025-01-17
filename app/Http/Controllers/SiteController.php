<?php

namespace App\Http\Controllers;

use App\Models\Avis;
use App\Models\Etape;
use App\Models\Sejour;
use App\Models\VCommande;
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

    public function conditions()
    {
        return view("legal.conditions-vente");
    }
    public function destinations()
    {
        return view("destinations");
    }

    public function aide()
    {
        return view("aide");
    }

    public function dialogflow(Request $request)
    {
        $MAX_SEJOURS = 4;

        if (isset($request->input('queryResult')['action'])) {
            switch ($request->input('queryResult')['action']) {
                case 'OffrirSejour':
                    $sejours = Sejour::whereRaw(
                        'LOWER(titresejour) LIKE LOWER(?)',
                        ['%' . $request->input('queryResult')['queryText'] . '%']
                    )->get()->toArray();

                    return response([
                        "fulfillmentMessages" => [
                            [
                                "payload" => [
                                    "richContent" => (
                                        sizeof($sejours) === 0 ? [
                                            [
                                                [
                                                    "type" => "description",
                                                    "title" => "Je n'ai pas trouvé de séjour.",
                                                    "text" => [
                                                        "Cependant, voici les étapes pour offrir un séjour :",
                                                        "1. Choisissez un séjour avec le lien ci-dessous.",
                                                        "2. Cliquez sur le bouton 'Personnaliser ou offrir'.",
                                                        "3. Remplissez les informations nécessaires (dates, hébergement, ...).",
                                                        "4. Cochez la case portant le libellé 'Offrir'.",
                                                        "5. Choisissez le format du coffret cadeau : électronique ou postal.",
                                                        "6. Ajoutez le séjour au panier.",
                                                        "7. Si par voie postale, au moment du paiement, choisissez l'adresse de livraison.",
                                                        "8. Terminez votre commande et récupérez votre code cadeau si nécessaire dans votre compte client."
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
                                                    "title" => "J'ai trouvé " . sizeof($sejours) . " séjour(s)." . (sizeof($sejours) > $MAX_SEJOURS ? " Voici les $MAX_SEJOURS premiers." : ''),
                                                    "text" => [
                                                        "Voici les étapes pour offrir un séjour :",
                                                        "1. Cliquez sur un des séjours ci-dessous.",
                                                        "2. Remplissez les informations nécessaires (dates, hébergement, ...).",
                                                        "3. Cochez la case portant le libellé 'Offrir'.",
                                                        "4. Choisissez le format du coffret cadeau : électronique ou postal.",
                                                        "5. Ajoutez le séjour au panier.",
                                                        "6. Si par voie postale, au moment du paiement, choisissez l'adresse de livraison.",
                                                        "7. Terminez votre commande et récupérez votre code cadeau si nécessaire dans votre compte client."
                                                    ]
                                                ]
                                            ],
                                            ...array_map(function ($sejour) {
                                                return [
                                                    [
                                                        "type" => "button",
                                                        "icon" => [
                                                            "type" => "explore",
                                                            "color" => "var(--df-messenger-send-icon)"
                                                        ],
                                                        "text" => $sejour['titresejour'],
                                                        "link" => "/personnaliser/{$sejour['idsejour']}"
                                                    ]
                                                ];
                                            }, array_slice($sejours, 0, $MAX_SEJOURS))
                                        ]
                                    )
                                ]
                            ]
                        ]
                    ]);

                case 'ListeSejours.Duree':
                    $sejours = Sejour::where(
                        'idduree',
                        '=',
                        $request->input('queryResult')['parameters']['duree']
                    )->get()->toArray();

                    return response([
                        "fulfillmentMessages" => [
                            [
                                "payload" => [
                                    "richContent" => [
                                        [
                                            [
                                                "type" => "description",
                                                "title" => "J'ai trouvé " . sizeof($sejours) . " séjour(s)." . (sizeof($sejours) > $MAX_SEJOURS ? " Voici les $MAX_SEJOURS premiers." : ''),
                                                "text" => [
                                                    "Vous pouvez également vous rendre sur la liste des séjours, et modifier les filtres à votre guise afin de n'afficher que les séjours qui vous intéressent."
                                                ]
                                            ]
                                        ],
                                        ...array_map(function ($sejour) {
                                            return [
                                                [
                                                    "type" => "button",
                                                    "icon" => [
                                                        "type" => "explore",
                                                        "color" => "var(--df-messenger-send-icon)"
                                                    ],
                                                    "text" => $sejour['titresejour'],
                                                    "link" => "/sejour/{$sejour['idsejour']}"
                                                ]
                                            ];
                                        }, array_slice($sejours, 0, $MAX_SEJOURS))
                                    ]
                                ]
                            ]
                        ]
                    ]);

                case 'ListeSejours.Prix':
                    $comparator = $request->input('queryResult')['parameters']['comparator'];

                    switch ($comparator) {
                        case 'égale':
                        case 'égal':
                        case 'de':
                            $comparator = '=';
                            break;
                        case 'moins':
                            $comparator = '<';
                            break;
                        case 'plus':
                            $comparator = '>';
                            break;
                        default:
                            $comparator = '=';
                            break;
                    }

                    $sejours = Sejour::where(
                        'prixsejour',
                        $comparator,
                        $request->input('queryResult')['parameters']['number']
                    )->get()->toArray();

                    return response([
                        "fulfillmentMessages" => [
                            [
                                "payload" => [
                                    "richContent" => [
                                        [
                                            [
                                                "type" => "description",
                                                "title" => "J'ai trouvé " . sizeof($sejours) . " séjour(s)." . (sizeof($sejours) > $MAX_SEJOURS ? " Voici les $MAX_SEJOURS premiers." : ''),
                                            ]
                                        ],
                                        ...array_map(function ($sejour) {
                                            return [
                                                [
                                                    "type" => "button",
                                                    "icon" => [
                                                        "type" => "explore",
                                                        "color" => "var(--df-messenger-send-icon)"
                                                    ],
                                                    "text" => $sejour['titresejour'],
                                                    "link" => "/sejour/{$sejour['idsejour']}"
                                                ]
                                            ];
                                        }, array_slice($sejours, 0, $MAX_SEJOURS))
                                    ]
                                ]
                            ]
                        ]
                    ]);

                case 'ListeSejours.Region':
                    $sejours = Sejour::with('categorievignoble')
                        ->whereHas('categorievignoble', function ($query) use ($request) {
                            $region = strtolower(trim($request->input('queryResult')['parameters']['region']));
                            $query->whereRaw('LOWER(libellecategorievignoble) = ?', [$region]);
                        })
                        ->get()
                        ->toArray();


                    return response([
                        "fulfillmentMessages" => [
                            [
                                "payload" => [
                                    "richContent" => [
                                        [
                                            [
                                                "type" => "description",
                                                "title" => "J'ai trouvé " . sizeof($sejours) . " séjour(s)." . (sizeof($sejours) > $MAX_SEJOURS ? " Voici les $MAX_SEJOURS premiers." : ''),
                                                "text" => [
                                                    "Vous pouvez également vous rendre sur la liste des séjours, et modifier les filtres à votre guise afin de n'afficher que les séjours qui vous intéressent."
                                                ]
                                            ]
                                        ],
                                        ...array_map(function ($sejour) {
                                            return [
                                                [
                                                    "type" => "button",
                                                    "icon" => [
                                                        "type" => "explore",
                                                        "color" => "var(--df-messenger-send-icon)"
                                                    ],
                                                    "text" => $sejour['titresejour'],
                                                    "link" => "/sejour/{$sejour['idsejour']}"
                                                ]
                                            ];
                                        }, array_slice($sejours, 0, $MAX_SEJOURS))
                                    ]
                                ]
                            ]
                        ]
                    ]);
            }
        }

        return response([
            'fulfillmentText' => "Je n'ai pas réussi à communiquer avec le site web."
        ]);
    }

}
