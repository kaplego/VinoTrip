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
                    <th scope="col">Référence Commande</th>
                    <th scope="col">Date</th>
                    <th scope="col">Prix Total</th>
                    <th scope="col">Paiement</th>
                    <th scope="col">Code Cadeau</th>
                    <th scope="col">État</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($commandes as $commande)
                    <tr>
                        <td><a href="/client/commande/{{ $commande->idcommande }}">{{ $commande->idcommande }}</a></td>
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
                            @if ($commande->codereduction)
                                <div class="clipboard-copy" data-text="{{ $commande->codereduction }}">
                                    {{ $commande->codereduction }}</div>
                            @else
                                Aucun code cadeau
                            @endif
                        </td>
                        <td>{{ $commande->etatcommande }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </main>
    @include('layout.footer')
@endsection
