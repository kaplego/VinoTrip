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
                        <th>État de la commande</th>
                        <th>Mode de paiement</th>
                        @if ($commande->codereduction)
                            <th>Code cadeau</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ date_format(date_create($commande->datecommande), 'd/m/Y') }}</td>
                        <td>
                            {{ $commande->etatcommande }}
                        </td>
                        <td>
                            @switch($commande->typepaiementcommande)
                                @case('cb')
                                    Carte bancaire @if ($commande->cartebancaire)
                                        •••• •••• •••• {{ substr($commande->cartebancaire->numerocbclient, -4) }}
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
                        @if ($commande->codereduction)
                            <td class="code-cadeau">
                                <div class="clipboard-copy" data-text="{{ $commande->codereduction }}">
                                    {{ $commande->codereduction }}</div>
                            </td>
                        @endif
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
                    <form action="" method="post">
                        @csrf
                        <input type="hidden" name="idsejour" value="{{ $sejour->idsejour }}">
                        <div class="sejour">
                            <h2>{{ $sejour->titresejour }}</h2>
                            <img class="photo" src="/assets/images/sejour/{{ $sejour->photosejour }}"
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
                    </form>
                </article>
            @endforeach
        </section>
    </main>
    @include('layout.footer')
@endsection
