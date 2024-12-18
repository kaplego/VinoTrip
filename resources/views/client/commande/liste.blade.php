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
        <h1>Mes commandes</h1>
        <hr class="separateur-titre" />

        <table>
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
                @foreach (Auth::user()->commandes as $commande)
                    @php
                        $prixTotal = 0;
                        foreach ($commande->descriptionscommande as $dc) {
                            $prixTotal += $dc->prix * $dc->quantite;
                        }
                    @endphp
                    <tr>
                        <td><a href="/client/commande/{{ $commande->idcommande }}">{{ $commande->idcommande }}</a></td>
                        <td>{{ $commande->datecommande }}</td>
                        <td>{{ $prixTotal }} €</td>
                        <td>{{ $commande->typepaiementcommande }}</td>
                        <td>{{ $commande->codereduction }}</td>
                        <td>{{ $commande->etatcommande }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </main>
    @include('layout.footer')
@endsection
