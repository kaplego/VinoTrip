<?php

namespace App\Http\Controllers;

use App\Models\Activite;
use App\Models\Association_38;
use App\Models\Association_39;
use App\Models\Association_40;
use App\Models\Cartebancaire;
use App\Models\Commande;
use App\Models\VCommande;
use App\Models\Descriptioncommande;
use App\Models\VDescriptioncommande;
use App\Models\Descriptionpanier;
use App\Models\VDescriptionpanier;
use App\Models\Hebergement;
use App\Models\Mange1;
use App\Models\Panier;
use App\Models\Repas;
use App\Models\Sejour;
use App\Models\CodePromo;
use App\Models\VPanier;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Str;

class PanierController extends Controller
{
    public function index(Request $request)
    {
        $idpanier = $request->session()->get('idpanier', null);

        $panier = null;
        if ($idpanier !== null) {
            $panier = VPanier::find($idpanier);
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

        $hebergements = Hebergement::join('etape', 'hebergement.idhebergement', '=', 'etape.idhebergement')
            ->where('etape.idsejour', '=', $idsejour)
            ->get();

        $repas = Repas::join('appartient_2', 'repas.idrepas', '=', second: 'appartient_2.idrepas')
            ->join('etape', 'appartient_2.idetape', '=', 'etape.idetape')
            ->where('etape.idsejour', '=', $idsejour)
            ->get();

        $activites = Activite::join('appartient_4', 'activite.idactivite', '=', second: 'appartient_4.idactivite')
            ->join('etape', 'appartient_4.idetape', '=', 'etape.idetape')
            ->where('etape.idsejour', '=', $idsejour)
            ->get();

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
            'hebergement' => ['required', 'in:' . implode(',', $hebergements->pluck('idhebergement')->toArray())],
            'repas' => ['array'],
            'repas.*' => ['in:' . implode(',', $repas->pluck('idrepas')->toArray())],
            'activites' => ['array'],
            'activites.*' => ['in:' . implode(',', $activites->pluck('idactivite')->toArray())],
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

        $descriptionPanier = VDescriptionpanier::
            where('idsejour', '=', +$idsejour)
            ->where('idpanier', '=', value: $idpanier)
            ->get()->first();

        if ($descriptionPanier !== null) {
            Descriptionpanier::
                where('idsejour', '=', +$idsejour)
                ->where('idpanier', '=', value: $idpanier)
                ->update([
                    'quantite' => 1,
                    'datedebut' => $inputs['datedebut'],
                    'datefin' => $inputs['datefin'],
                    'nbadultes' => $inputs['nbadultes'],
                    'nbenfants' => $inputs['nbenfants'],
                    'nbchambressimple' => $inputs['chambressimple'],
                    'nbchambresdouble' => $inputs['chambresdouble'],
                    'nbchambrestriple' => $inputs['chambrestriple'],
                    'idhebergement' => $inputs['hebergement'],
                    'offrir' => isset($inputs['offrir']) && $inputs['offrir'] == '1',
                    'ecoffret' => isset($inputs['offrir']) && $inputs['offrir'] &&
                        isset($inputs['ecoffret']) && $inputs['ecoffret'] == '1'
                ]);
            Association_38::
                where('iddescriptionpanier', '=', $descriptionPanier->iddescriptionpanier)
                ->delete();
            Association_39::
                where('iddescriptionpanier', '=', $descriptionPanier->iddescriptionpanier)
                ->delete();
        } else {
            $descriptionPanier = Descriptionpanier::
                create([
                    'idsejour' => $sejour->idsejour,
                    'idpanier' => $panier->idpanier,
                    'quantite' => 1,
                    'datedebut' => $inputs['datedebut'],
                    'datefin' => $inputs['datefin'],
                    'nbadultes' => $inputs['nbadultes'],
                    'nbenfants' => $inputs['nbenfants'],
                    'nbchambressimple' => $inputs['chambressimple'],
                    'nbchambresdouble' => $inputs['chambresdouble'],
                    'nbchambrestriple' => $inputs['chambrestriple'],
                    'idhebergement' => $inputs['hebergement'],
                    'offrir' => isset($inputs['offrir']) && $inputs['offrir'] == '1',
                    'ecoffret' => isset($inputs['offrir']) && $inputs['offrir'] &&
                        isset($inputs['ecoffret']) && $inputs['ecoffret'] == '1'
                ]);
        }
        if (isset($inputs['activites']))
            foreach ($inputs['activites'] as $activite) {
                Association_38::create([
                    'iddescriptionpanier' => $descriptionPanier->iddescriptionpanier,
                    'idactivite' => $activite
                ]);
            }
        if (isset($inputs['repas']))
            foreach ($inputs['repas'] as $repas) {
                Association_39::create([
                    'iddescriptionpanier' => $descriptionPanier->iddescriptionpanier,
                    'idrepas' => $repas
                ]);
            }

        return redirect('/panier');
    }

    public function update(Request $request)
    {
        $iddescriptionpanier = $request->input('iddescriptionpanier') ?? null;
        $idpanier = $request->session()->get('idpanier', null);

        $inputs = $request->validate([
            'action' => ['in:update,delete']
        ]);

        switch ($inputs['action']) {
            case 'delete':
                Association_38::
                    where('iddescriptionpanier', '=', $iddescriptionpanier)
                        ?->delete();
                Association_39::
                    where('iddescriptionpanier', '=', $iddescriptionpanier)
                        ?->delete();
                Descriptionpanier::
                    find($iddescriptionpanier)
                        ?->delete();

                if (
                    VDescriptionpanier::where('idpanier', '=', value: $idpanier)->count() === 0
                ) {
                    Panier::find($idpanier)?->delete();
                }
                break;
            case 'update':
                $updateInputs = $request->validate([
                    'quantite' => ['integer', 'between:1,10']
                ]);
                if (+$updateInputs['quantite'] > 0)
                    Descriptionpanier::
                        find($iddescriptionpanier)
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

        if (!$sejour)
            return redirect('/sejours');

        if (!$sejour->publie)
            return redirect("/sejour/$id");

        return view('panier.personnaliser', ['sejour' => $sejour]);
    }

    public function modifier($idsejour, Request $request)
    {
        $idpanier = $request->session()->get('idpanier', null);
        if ($idpanier === null)
            return redirect("/personnaliser/$idsejour");

        $descriptionPanier = VDescriptionpanier::
            where('idsejour', '=', +$idsejour)
            ->where('idpanier', '=', value: $idpanier)
            ->get()->first();

        if (!$descriptionPanier)
            return redirect("/personnaliser/$idsejour");

        if ($descriptionPanier->codepromoutilise !== null)
            return redirect('/panier');

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

        $livraison = false;
        foreach ($panier->descriptionspanier as $dp) {
            if ($dp->offrir && !$dp->ecoffret) {
                $livraison = true;
                break;
            }
        }

        return view('panier.paiement', ['panier' => $panier, 'livraison' => $livraison]);
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
            'adresse-livraison' => ['integer'],
            'type-paiement' => ['required', 'in:cb-old,cb-new,paypal,stripe'],
            'cb-titulaire' => ['present_if:type-paiement,cb-new'],
            'numero-cb' => ['present_if:type-paiement,cb-new', 'regex:/^\d{16}|\d{4} \d{4} \d{4} \d{4}$/'],
            'ccv-cb' => ['present_if:type-paiement,cb-new', 'digits:3'],
            'cb-exp-mois' => ['present_if:type-paiement,cb-new', 'integer', 'between:1,12'],
            'cb-exp-annee' => ['present_if:type-paiement,cb-new', 'integer', 'between:' . Date('Y') . ',' . (intval(Date('Y')) + 20)],
            'save-infos-cb' => ['boolean']
        ], [
            'adresse-facturation' => "L'adresse de facturation est incorrecte.",
            'adresse-facturation.required' => "L'adresse de facturation est requise.",
            'type-paiement' => 'La carte bancaire choisie est incorrecte.',
            'type-paiement.required' => 'Vous devez choisir une carte bancaire.',
            'cb-titulaire' => 'Le titulaire est incorrect.',
            'numero-cb' => 'Le numéro de carte bacaire est incorrect.',
            'numero-cb.present_if' => "Le numéro de carte bancaire est requis.",
            'ccv-cb' => "Le code de sécurité est incorrect.",
            'ccv-cb.present_if' => "Le code de sécurité est requis.",
            'cb-exp-mois' => "Le mois d'expiration est incorrect.",
            'cb-exp-mois.present_if' => "Le mois d'expiration est requis.",
            'cb-exp-annee' => "L'année d'expiration est incorrecte.",
            'cb-exp-annee.present_if' => "L'année d'expiration est requise.",
            'cb-exp-annee.between' => "L'année d'expiration doit être entre " . Date('Y') . " et " . (intval(Date('Y')) + 20) . ".",
        ]);

        if ($inputs['type-paiement'] === 'cb-new') {
            $inputs['numero-cb'] = str_replace(' ', '', $inputs['numero-cb']);
            $inputs['save-infos-cb'] = isset($inputs['save-infos-cb']) && $inputs['save-infos-cb'] == 1;
        }

        $cb = null;
        if ($inputs['type-paiement'] === 'cb-new') {
            if ($inputs['save-infos-cb']) {
                if (Cartebancaire::where('idclient', '=', Auth::user()->idclient)->exists()) {
                    $cb = Cartebancaire::where('idclient', '=', Auth::user()->idclient)
                        ->update([
                            'actif' => true,
                        ]);
                    $cb = Cartebancaire::create([
                        'idclient' => Auth::user()->idclient,
                        'titulairecb' => $inputs['cb-titulaire'],
                        'numerocbclient' => $inputs['numero-cb'],
                        'dateexpirationcbclient' => Carbon::createFromFormat(
                            'n-Y',
                            $inputs['cb-exp-mois'] . '-' . $inputs['cb-exp-annee'],
                        )
                    ]);
                } else
                    $cb = Cartebancaire::create([
                        'idclient' => Auth::user()->idclient,
                        'titulairecb' => $inputs['cb-titulaire'],
                        'numerocbclient' => $inputs['numero-cb'],
                        'dateexpirationcbclient' => Carbon::createFromFormat(
                            'n-Y',
                            $inputs['cb-exp-mois'] . '-' . $inputs['cb-exp-annee'],
                        )
                    ]);
            } else {
                $cb = Cartebancaire::create([
                    'idclient' => Auth::user()->idclient,
                    'titulairecb' => $inputs['cb-titulaire'],
                    'numerocbclient' => $inputs['numero-cb'],
                    'dateexpirationcbclient' => Carbon::createFromFormat(
                        'n-Y',
                        $inputs['cb-exp-mois'] . '-' . $inputs['cb-exp-annee'],
                    ),
                    'actif' => false
                ]);
            }
            $cb = $cb->idcb;
        } else if ($inputs['type-paiement'] === 'cb-old') {
            $cb = Auth::user()->cartebancaire->idcb;
        }

        $commande = Commande::create([
            'idclientacheteur' => Auth::user()->idclient,
            'idpanier' => $idpanier,
            'idadressefacturation' => $inputs['adresse-facturation'],
            'idadresselivraison' => $inputs['adresse-livraison'] ?? null,
            'idcb' => $cb,
            'etatcommande' => 'En attente de validation',
            'typepaiementcommande' => str_starts_with($inputs['type-paiement'], 'cb') ? 'cb' : $inputs['type-paiement'],
            'datecommande' => date('Y-m-d'),
            'codereduction' => ''
        ]);

        $offrir = false;

        foreach ($panier->descriptionspanier as $dp) {
            if ($dp->offrir)
                $offrir = true;
            $dc = Descriptioncommande::create([
                'idsejour' => $dp->idsejour,
                'idcommande' => $commande->idcommande,
                'quantite' => $dp->quantite,
                'datedebut' => $dp->datedebut,
                'datefin' => $dp->datefin,
                'nbadultes' => $dp->nbadultes,
                'nbenfants' => $dp->nbenfants,
                'nbchambressimple' => $dp->nbchambressimple,
                'nbchambresdouble' => $dp->nbchambresdouble,
                'nbchambrestriple' => $dp->nbchambrestriple,
                'idhebergement' => $dp->idhebergement,
                'disponibilitehebergement' => false,
                'validationclient' => false,
                'offrir' => $dp->offrir,
                'ecoffret' => $dp->ecoffret,
            ]);
            foreach ($dp->activites as $activite) {
                Association_40::create([
                    'iddescriptioncommande' => $dc->iddescriptioncommande,
                    'idactivite' => $activite->idactivite
                ]);
            }
            foreach ($dp->repas as $repas) {
                Mange1::create([
                    'iddescriptioncommande' => $dc->iddescriptioncommande,
                    'idrepas' => $repas->idrepas
                ]);
            }
        }

        if ($offrir) {
            $code = Str::random(11);
            $commande->update([
                'codereduction' => $code
            ]);
        }

        $request->session()->remove('idpanier');

        return redirect("/client/commande/$commande->idcommande");
    }
    public function codepromo(Request $request)
    {
        $code = $request->input("codePromo");

        $codepromo = CodePromo::where('libellecodepromo', '=', $code)->first();

        if (!$codepromo)
            return back()->withErrors([
                'alert' => "Le code promo n'existe pas."
            ]);

        $panier = Panier::find($request->session()->get('idpanier'));

        if (!$panier)
            return back()->withErrors([
                'alert' => "Vous devez ajouter un séjour dans votre panier."
            ]);

        $panier->update([
            'idcodepromo' => $codepromo->idcodepromo
        ]);

        return back()->with('alert-success', 'Le code promo a été appliqué.');
    }
}
