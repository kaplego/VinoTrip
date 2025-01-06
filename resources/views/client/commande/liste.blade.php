@php
    $active = 'compte';
@endphp

@extends('layout.app')

@section('title', 'Mes commandes - VinoTrip')

@section('head')
    <link rel="stylesheet" href="/assets/css/client/commandes.css">
@endsection

@section('body')
    @include('layout.header')
    <main class="container-sm">
        @include('layout.breadcrumb')

        <h1>Mes commandes ({{ sizeof($commandes) }})</h1>
        <hr class="separateur-titre" />

        <table class="liste">
            <thead>
                <tr>
                    <th scope="col">Réf.</th>
                    <th scope="col">Date</th>
                    <th scope="col">Prix Total</th>
                    <th scope="col">Paiement</th>
                    <th scope="col">Code Cadeau</th>
                    <th scope="col">État</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($commandes as $commande)
                    <tr>
                        <td>{{ $commande->idcommande }}</td>
                        <td>{{ date_format(date_create($commande->datecommande), 'd/m/Y') }}</td>
                        <td>{{ $commande->prix }} €</td>
                        <td>
                            @switch($commande->typepaiementcommande)
                                @case('cb')
                                    Carte bancaire
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
                        <td>
                            @if ($commande->codereduction && !str_contains($commande->etatcommande, 'refusé'))
                                <div class="clipboard-copy" data-text="{{ $commande->codereduction }}">
                                    {{ $commande->codereduction }}</div>
                            @else
                                Aucun code cadeau
                            @endif
                        </td>
                        <td>{{ $commande->etatcommande }} @if (str_contains($commande->etatcommande, 'refusé'))
                                <div
                                    data-help="Vérifiez que le solde de votre compte est suffisant, puis essayez à nouveau.">
                                </div>
                            @elseif ($commande->etatcommande === 'En attente de validation')
                                <div
                                    data-help="Vous recevrez un e-mail lorsque nous recevrons une réponse positive de nos partenaires.">
                                </div>
                            @elseif ($commande->etatcommande === 'Paiement validé')
                                <div data-help="Nous allons bientôt traiter votre commande.">
                                </div>
                            @endif
                        </td>
                        <td><a href="/client/commande/{{ $commande->idcommande }}" class="button button-sm">Détails</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </main>
    @include('layout.footer')
@endsection
