@php
    $active = 'compte';
@endphp

@extends('layout.app')

@section('title', 'Commande complétée - VinoTrip')

@section('head')
    <link rel="stylesheet" href="/assets/css/panier/panier.css">
    <link rel="stylesheet" href="/assets/css/client/commandes.css">
@endsection

@section('body')
    @include('layout.header')
    <main class="container-sm">
        @php
            $breadcrumReplaceLink = ['/client/commande' => '/client/commandes'];
            $breadcrumReplaceName = [
                '/client/commande' => 'Commandes',
            ];
        @endphp
        @include('layout.breadcrumb')

        <h1>Détail de la commande #{{ $commande->idcommande }}</h1>
        <hr class="separateur-titre" />
        <section id="details-commande">
            <table class="liste">
                <thead>
                    <tr>
                        <th>Date de la commande</th>
                        @if ($commande->idcodepromo)
                            <th>Code promo</th>
                        @endif
                        <th><div class="flex-help">Prix total <div data-help="Le prix est TTC"></div></div></th>
                        <th>Mode de paiement</th>
                        @if ($commande->codereduction && !str_contains($commande->etatcommande, 'refusé'))
                            <th>Code cadeau</th>
                        @endif
                        <th>État de la commande</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ date_format(date_create($commande->datecommande), 'd/m/Y') }}</td>
                        @if ($commande->idcodepromo)
                            <td>-{{ number_format($commande->reduction, 2, ',', ' ') }} €</td>
                        @endif
                        <td>{{ number_format($commande->prixreduit, 2, ',', ' ') }} €</td>
                        <td>
                            @switch($commande->typepaiementcommande)
                                @case('cb')
                                    Carte bancaire @if ($commande->cartebancaire && $commande->cartebancaire->idcb)
                                        •••• •••• •••• {{ $commande->cartebancaire->fincodecarte }}
                                    @endif
                                @break

                                @case('paypal')
                                    PayPal
                                @break

                                @case('stripe')
                                    Stripe
                                @break

                                @default
                                    Inconnu
                            @endswitch
                        </td>
                        @if ($commande->codereduction && !str_contains($commande->etatcommande, 'refusé'))
                            <td class="code-cadeau">
                                <div class="clipboard-copy" data-text="{{ $commande->codereduction }}">
                                    {{ $commande->codereduction }}</div>
                            </td>
                        @endif
                        <td>
                            {{ $commande->etatcommande }} @if (str_contains($commande->etatcommande, 'refusé'))
                                <div
                                    data-help="Vérifiez que le solde de votre compte est suffisant, puis essayez à nouveau.">
                                </div>
                            @elseif ($commande->etatcommande === 'En attente de validation')
                                <div
                                    data-help="Vous recevrez un e-mail lorsque nous recevrons une réponse positive de nos partenaires.">
                                </div>
                            @elseif ($commande->etatcommande === 'Paiement validé')
                                <div
                                    data-help="Nous allons bientôt traiter votre commande.">
                                </div>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </section>
        <section id="liste-sejours">
            @foreach ($commande->descriptionscommande ?? [] as $descriptioncommande)
                @php
                    $sejour = $descriptioncommande->sejour;
                    $nbPersonnes = $descriptioncommande->nbadultes + $descriptioncommande->nbenfants;
                @endphp
                <article class="descriptionpanier">
                    <div class="sejour">
                        <h2>{{ $sejour->titresejour }}</h2>
                        <img class="photo" src="/storage/sejour/{{ $sejour->photosejour }}"
                            alt="{{ $sejour->titresejour }}">
                    </div>
                    <table class="details">
                        <tbody>
                            <tr>
                                <td>Dates</td>
                                <td colspan="2">Départ
                                    {{ date_format(new DateTime($descriptioncommande->datedebut), 'd/m/Y') }}<br />
                                    Retour {{ date_format(new DateTime($descriptioncommande->datefin), 'd/m/Y') }}
                                </td>
                            </tr>
                            <tr>
                                <td>Adultes</td>
                                <td>{{ $descriptioncommande->nbadultes }}</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Enfants</td>
                                <td>{{ $descriptioncommande->nbenfants }}</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Chambres</td>
                                <td>{{ $descriptioncommande->nbchambressimple }} simple<br />
                                    {{ $descriptioncommande->nbchambresdouble }} double<br />
                                    {{ $descriptioncommande->nbchambrestriple }} triple</td>
                                <td class="prix">{{ $descriptioncommande->nbchambressimple * 75 }} €
                                    <br />{{ $descriptioncommande->nbchambresdouble * 100 }} €
                                    <br />{{ $descriptioncommande->nbchambrestriple * 125 }} €
                                </td>
                            </tr>
                            <tr>
                                <td>Repas</td>
                                <td>
                                    @if (sizeof($descriptioncommande->repas) === 0)
                                        Aucun repas
                                    @endif
                                    @foreach ($descriptioncommande->repas as $repas)
                                        <div>{{ $repas->restaurant->nompartenaire }}</div>
                                    @endforeach
                                </td>
                                <td class="prix">
                                    @if (sizeof($descriptioncommande->repas) === 0)
                                        0 €
                                    @endif
                                    @foreach ($descriptioncommande->repas as $repas)
                                        <div>{{ $nbPersonnes }} × {{ $repas->prixrepas }} €</div>
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <td>Cadeau</td>
                                <td>
                                    @if ($descriptioncommande->offrir)
                                        oui,
                                        {{ $descriptioncommande->ecoffret ? 'e-coffret' : 'coffret postal' }}
                                    @else
                                        non
                                    @endif
                                </td>
                                <td class="prix">
                                    {{ $descriptioncommande->offrir && !$descriptioncommande->ecoffret ? 5 : 0 }} €
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="prix-total">
                        <span class="text">Prix total</span>
                        <span
                            class="prix">{{ number_format($descriptioncommande->prix * $descriptioncommande->quantite, 2, ',', ' ') }}
                            €</span>
                    </div>
                </article>
            @endforeach
        </section>
    </main>
    @include('layout.footer')
@endsection
