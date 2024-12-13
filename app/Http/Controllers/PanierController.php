<?php

namespace App\Http\Controllers;

use App\Models\Activite;
use App\Models\Association_38;
use App\Models\Association_39;
use App\Models\Cartebancaire;
use App\Models\Client;
use App\Models\Descriptionpanier;
use App\Models\Hebergement;
use App\Models\Panier;
use App\Models\Repas;
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

        $idshebergements = Hebergement::join('etape', 'hebergement.idhebergement', '=', 'etape.idhebergement')
            ->where('etape.idsejour', '=', $idsejour)
            ->get(['hebergement.idhebergement'])
            ->pluck('idhebergement')->toArray();

        $idsrepas = Repas::join('appartient_2', 'repas.idrepas', '=', second: 'appartient_2.idrepas')
            ->join('etape', 'appartient_2.idetape', '=', 'etape.idetape')
            ->where('etape.idsejour', '=', $idsejour)
            ->get(['repas.idrepas'])
            ->pluck('idrepas')->toArray();

        $idsactivites = Activite::join('appartient_4', 'activite.idactivite', '=', second: 'appartient_4.idactivite')
            ->join('etape', 'appartient_4.idetape', '=', 'etape.idetape')
            ->where('etape.idsejour', '=', $idsejour)
            ->get(['activite.idactivite'])
            ->pluck('idactivite')->toArray();

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
            'hebergement' => ['required', 'in:' . implode(',', $idshebergements)],
            'repas' => ['array'],
            'repas.*' => ['in:' . implode(',', $idsrepas)],
            'activites' => ['array'],
            'activites.*' => ['in:' . implode(',', $idsactivites)],
            'offrir' => ['boolean'],
            'ecoffret' => ['boolean', 'required_if:offrir,true']
        ], [
            'datedebut' => 'Vous devez choisir une date de départ.',
            'datefin' => "Vous devez choisir une date de départ afin d'ajouter automatiquement la date de retour.",
            'nbadultes' => "Le nombre d'adultes est incorrect.",
            'nbenfants' => "Le nombre d'enfants est incorrect.",
            'chambressimple' => 'Le nombre de chambres simples est incorrect.',
            'chambredouble' => 'Le nombre de chambres double est incorrect.',
            'chambretriple' => 'Le nombre de chambres triple est incorrect.',
            'hebergement' => "L'hébergement est incorrect.",
            'hebergement.required' => "Vous devez choisir un hébergement.",
            'repas' => 'Les repas sont incorrects.',
            'activites' => 'Les activités sont incorrectes.',
            'ecoffret.required_if' => 'Vous devez choisir un type de coffret.'
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
                    'idhebergement' => $inputs['hebergement'],
                    'repasmidi' => false,
                    'repassoir' => false,
                    'activite' => false,
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
                    'idhebergement' => $inputs['hebergement'],
                    'repasmidi' => false,
                    'repassoir' => false,
                    'activite' => false,
                    'offrir' => isset($inputs['offrir']) && $inputs['offrir'] == '1',
                    'ecoffret' => isset($inputs['offrir']) && $inputs['offrir'] &&
                        isset($inputs['ecoffret']) && $inputs['ecoffret'] == '1'
                ]);
            foreach ($inputs['activites'] as $activite) {
                Association_38::create([
                    'idsejour' => $sejour->idsejour,
                    'idpanier' => $panier->idpanier,
                    'idactivite' => $activite
                ]);
            }
            foreach ($inputs['repas'] as $repas) {
                Association_39::create([
                    'idsejour' => $sejour->idsejour,
                    'idpanier' => $panier->idpanier,
                    'idrepas' => $repas
                ]);
            }
        }

        return redirect('/panier');
    }

    public function update(Request $request)
    {
        $idsejour = $request->input('idsejour') ?? null;
        $idpanier = $request->session()->get('idpanier', null);

        $inputs = $request->validate([
            'action' => ['in:update,delete']
        ]);

        switch ($inputs['action']) {
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
                $updateInputs = $request->validate([
                    'quantite' => ['integer', 'between:1,10']
                ]);
                if (+$updateInputs['quantite'] > 0)
                    Descriptionpanier::
                        where('idsejour', '=', +$idsejour)
                        ->where('idpanier', '=', +$idpanier)
                        ->update([
                            'quantite' => +$updateInputs['quantite']
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

        $cbs = Cartebancaire::where('idclient', '=', Auth::user()->idclient)
            ->get(['idcb'])
            ->pluck('idcb')->toArray();

        $inputs = $request->validate([
            'adresse-facturation' => ['required', 'integer'],
            'carte-bancaire' => ['required', 'in:' . implode(',', ['new', ...$cbs])],
            'cb-titulaire' => ['required_if:carte-bancaire,new'],
            'numero-cb' => ['required_if:carte-bancaire,new', 'regex:/^\d{16}|\d{4} \d{4} \d{4} \d{4}$/'],
            'ccv-cb' => ['required_if:carte-bancaire,new', 'digits:3'],
            'cb-exp-mois' => ['required_if:carte-bancaire,new', 'integer', 'between:1,12'],
            'cb-exp-annee' => ['required_if:carte-bancaire,new', 'integer', 'between:' . Date('Y') . ',' . (intval(Date('Y')) + 20)],
            'save-infos-cb' => ['boolean']
        ], [
            'adresse-facturation' => "L'adresse de facturation est incorrecte.",
            'adresse-facturation.required' => "L'adresse de facturation est requise.",
            'carte-bancaire' => 'La carte bancaire choisie est incorrecte.',
            'carte-bancaire.required' => 'Vous devez choisir une carte bancaire.',
            'cb-titulaire' => 'Le titulaire est incorrect.',
            'numero-cb' => 'Le numéro de carte bacaire est incorrect.',
            'numero-cb.required_if' => "Le numéro de carte bancaire est requis.",
            'ccv-cb' => "Le code de sécurité est incorrect.",
            'ccv-cb.required_if' => "Le code de sécurité est requis.",
            'cb-exp-mois' => "Le mois d'expiration est incorrect.",
            'cb-exp-mois.required_if' => "Le mois d'expiration est requis.",
            'cb-exp-annee' => "L'année d'expiration est incorrecte.",
            'cb-exp-annee.required_if' => "L'année d'expiration est requise.",
            'cb-exp-annee.between' => "L'année d'expiration doit être entre " . Date('Y') . " et " . (intval(Date('Y')) + 20) . ".",
        ]);

        $inputs['numero-cb'] = str_replace(' ', '', $inputs['numero-cb']);
        $inputs['save-infos-cb'] = isset($inputs['save-infos-cb']) && $inputs['save-infos-cb'] == 1;

        dd(vars: $inputs);

        if ($inputs['carte-bancaire'] === 'new') {
            if ($inputs['save-infos-cb']) {
                Cartebancaire::create([
                    'idclient' => Auth::user()->idclient,
                    'titulairecb' => $inputs['cb-titulaire'],
                    'numerocbclient' => $inputs['numero-cb'],
                    'dateexpirationcbclient' => DateTime::createFromFormat(
                        'j/n/Y',
                        1,
                        $inputs['cb-exp-mois'],
                        $inputs['cb-exp-annee'],
                    )
                ]);
            }
        }
    }
}
