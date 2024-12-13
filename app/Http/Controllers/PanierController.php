<?php

namespace App\Http\Controllers;

use App\Models\Activite;
use App\Models\Descriptionpanier;
use App\Models\Panier;
use App\Models\Sejour;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PanierController extends Controller
{
    public function index(Request $request)
    {
        $idpanier = $request->session()->get('idpanier', null);

        $panier = null;
        if ($idpanier !== null) {
            $panier = Panier::find($idpanier);
        }

        return view("panier.panier", ["panier" => $panier]);
    }

    public function add(Request $request)
    {
        $inputSejour = $request->validate([
            'idsejour' => ['required', 'integer']
        ]);

        $idsejour = $inputSejour['idsejour'];
        $sejour = Sejour::find($idsejour);

        if ($sejour === null)
            return redirect('/panier');

        // $idsactivites = Activite::join('appartient_4', 'activite.idactivite', '=', second: 'appartient_4.idactivite')
        //     ->join('etape', 'appartient_4.idetape', '=', 'etape.idetape')
        //     ->where('etape.idsejour', '=', $idsejour)
        //     ->get(['activite.idactivite']);

        $duree = 0;
        switch ($sejour->duree->idduree) {
            case 2:
                $duree = 1;
            case 3:
                $duree = 2;
        }

        $inputs = $request->validate([
            'datedebut' => ['required', 'date', 'after:today'],
            'datefin' => [
                'required',
                'date',
                // 'date_equals:' . Carbon::parse($request->datedebut)->setTime(12, 0)->addDays($duree)->format('Y-m-d')
            ],
            'nbadultes' => ['required', 'integer', 'min:1'],
            'nbenfants' => ['required', 'integer', 'min:0'],
            'chambressimple' => ['required', 'integer', 'min:0'],
            'chambresdouble' => ['required', 'integer', 'min:0'],
            'chambrestriple' => ['required', 'integer', 'min:0'],
            'dejeuner' => ['boolean'],
            'diner' => ['boolean'],
            // 'activites' => ['array'],
            // 'activites.*' => [
            //     'in:' . implode(
            //         ',',
            //         $idsactivites->pluck('idactivite')->toArray()
            //     )
            // ],
            'activite' => ['boolean'],
            'offrir' => ['boolean'],
            'ecoffret' => ['boolean', 'required_if:offrir,true']
        ]);

        $idpanier = $request->session()->get('idpanier', null);

        $panier = Panier::find($idpanier);
        if ($panier === null) {
            $panier = new Panier;
            $panier->dateheurepanier = now();
            $panier->save();

            $request->session()->put('idpanier', $panier->idpanier);
        }

        $descriptionPanier = Descriptionpanier::
            where('idsejour', '=', +$idsejour)
            ->where('idpanier', '=', value: $idpanier)
            ->get()->first();

        $prix = $sejour->prixsejour;
        if (isset($inputs['dejeuner']) && $inputs['dejeuner'] == '1')
            $prix += 20;
        if (isset($inputs['diner']) && $inputs['diner'] == '1')
            $prix += 20;
        if (isset($inputs['activite']) && $inputs['activite'] == '1')
            $prix += 50;
        // $prix += sizeof($inputs['activites'] ?? []) * 50;
        $prix *= +$inputs['nbadultes'] + +$inputs['nbenfants'];

        if (isset($inputs['offrir']) && $inputs['offrir'] == '1' && $inputs['ecoffret'] == '0')
            $prix += 5;
        $prix += ($inputs['chambressimple'] ?? 0) * 75;
        $prix += ($inputs['chambresdouble'] ?? 0) * 100;
        $prix += ($inputs['chambrestriple'] ?? 0) * 125;

        if ($descriptionPanier !== null) {
            Descriptionpanier::
                where('idsejour', '=', +$idsejour)
                ->where('idpanier', '=', value: $idpanier)
                ->update([
                    'prix' => $prix,
                    'quantite' => 1,
                    'datedebut' => $inputs['datedebut'],
                    'datefin' => $inputs['datefin'],
                    'nbadultes' => $inputs['nbadultes'],
                    'nbenfants' => $inputs['nbenfants'],
                    'nbchambressimple' => $inputs['chambressimple'],
                    'nbchambresdouble' => $inputs['chambresdouble'],
                    'nbchambrestriple' => $inputs['chambrestriple'],
                    'repasmidi' => ($inputs['dejeuner'] ?? 0) == '1',
                    'repassoir' => ($inputs['diner'] ?? 0) == '1',
                    'activite' => ($inputs['activite'] ?? 0) == '1',
                    'offrir' => isset($inputs['offrir']) && $inputs['offrir'] == '1',
                    'ecoffret' => isset($inputs['offrir']) && $inputs['offrir'] &&
                        isset($inputs['ecoffret']) && $inputs['ecoffret'] == '1'
                ]);
        } else {
            Descriptionpanier::
                create([
                    'idsejour' => $sejour->idsejour,
                    'idpanier' => $panier->idpanier,
                    'prix' => $prix,
                    'quantite' => 1,
                    'datedebut' => $inputs['datedebut'],
                    'datefin' => $inputs['datefin'],
                    'nbadultes' => $inputs['nbadultes'],
                    'nbenfants' => $inputs['nbenfants'],
                    'nbchambressimple' => $inputs['chambressimple'],
                    'nbchambresdouble' => $inputs['chambresdouble'],
                    'nbchambrestriple' => $inputs['chambrestriple'],
                    'repasmidi' => ($inputs['dejeuner'] ?? 0) == '1',
                    'repassoir' => ($inputs['diner'] ?? 0) == '1',
                    'activite' => ($inputs['activite'] ?? 0) == '1',
                    'offrir' => isset($inputs['offrir']) && $inputs['offrir'] == '1',
                    'ecoffret' => isset($inputs['offrir']) && $inputs['offrir'] &&
                        isset($inputs['ecoffret']) && $inputs['ecoffret'] == '1'
                ]);
        }

        return redirect('/panier');
    }

    public function update(Request $request)
    {
        $idsejour = $request->input('idsejour') ?? null;
        $idpanier = $request->session()->get('idpanier', null);

        $action = $request->input('action');

        switch ($action) {
            case 'delete':
                Descriptionpanier::
                    where('idsejour', '=', +$idsejour)
                    ->where('idpanier', '=', value: $idpanier)
                    ->delete();

                if (
                    Descriptionpanier::where('idpanier', '=', value: $idpanier)->count() === 0
                ) {
                    Panier::find($idpanier)->delete();
                }
                break;
            case 'update':
                $quantite = +$request->input('quantite');
                if ($quantite > 0)
                    Descriptionpanier::
                        where('idsejour', '=', +$idsejour)
                        ->where('idpanier', '=', value: $idpanier)
                        ->update([
                            'quantite' => $quantite
                        ]);
                break;
        }

        return redirect('/panier');
    }

    public function personnaliser($id)
    {
        $sejour = Sejour::find($id);
        return view('panier.personnaliser', ['sejour' => $sejour]);
    }

    public function modifier($idsejour, Request $request)
    {
        $idpanier = $request->session()->get('idpanier', null);
        if ($idpanier === null)
            return redirect("/personnaliser/$idsejour");

        $descriptionPanier = Descriptionpanier::
            where('idsejour', '=', +$idsejour)
            ->where('idpanier', '=', value: $idpanier)
            ->get()->first();

        if (!$descriptionPanier)
            return redirect("/personnaliser/$idsejour");

        return view('panier.modifier', ['descriptionPanier' => $descriptionPanier]);
    }

    public function paiement(Request $request)
    {
        $idpanier = $request->session()->get('idpanier', null);

        $panier = null;
        if ($idpanier !== null) {
            $panier = Panier::find($idpanier);
        }

        if (!$panier)
            return redirect("/panier");

        if (!Auth::check())
            return view('client.connexion', ['panier' => $panier, 'redirect' => '/panier/paiement']);

        return view('panier.paiement', ['panier' => $panier]);
    }

    public function payment(Request $request)
    {
        $idpanier = $request->session()->get('idpanier', null);

        $panier = null;
        if ($idpanier !== null) {
            $panier = Panier::find($idpanier);
        }

        if (!$panier)
            return redirect("/panier");

        $inputs = $request->validate([
            'adresse-facturation' => ['required', 'integer'],
            'numero-cb' => ['required', 'regex:/^\d{16}|\d{4} \d{4} \d{4} \d{4}$/'],
            'ccv-cb' => ['required', 'digits:3'],
            'cb-exp-mois' => ['required', 'integer', 'between:1,12'],
            'cb-exp-annee' => ['required', 'integer', 'between:' . Date('Y') . ',' . (intval(Date('Y')) + 20)],
            'save-infos-cb' => ['boolean']
        ], [
            'adresse-facturation' => "L'adresse de facturation est incorrecte.",
            'adresse-facturation.required' => "L'adresse de facturation est requise.",
            'numero-cb' => 'Le numéro de carte bacaire est incorrect.',
            'numero-cb.required' => "Le numéro de carte bancaire est requis.",
            'ccv-cb' => "Le code de sécurité est incorrect.",
            'ccv-cb.required' => "Le code de sécurité est requis.",
            'cb-exp-mois' => "Le mois d'expiration est incorrect.",
            'cb-exp-mois.required' => "Le mois d'expiration est requis.",
            'cb-exp-annee' => "L'année d'expiration est incorrecte.",
            'cb-exp-annee.required' => "L'année d'expiration est requise.",
            'cb-exp-annee.between' => "L'année d'expiration doit être entre " . Date('Y') . " et " . (intval(Date('Y')) + 20) . ".",
        ]);

        $inputs['numero-cb'] = str_replace(' ', '', $inputs['numero-cb']);
        $inputs['save-infos-cb'] = isset($inputs['save-infos-cb']) && $inputs['save-infos-cb'] == 1;

        dd(vars: $inputs);
    }
}
