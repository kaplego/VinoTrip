@php
    $active = 'panier';
@endphp

@extends('layout.app')

@section('title', 'Paiement (' . sizeof($panier?->descriptionspanier ?? []) . ') - VinoTrip')

@section('head')
    <link rel="stylesheet" href="/assets/css/panier/panier.css">
@endsection

@section('body')
    @include('layout.header')
    <main class="container-sm">
        <h1>Paiement</h1>
        <hr class="separateur-titre" />
        <form>
            <div id="paiement">
                <div id="prix">
                    <p class="text">Prix TTC</p>
                    <p class="value">
                        {{ array_reduce(
                            [$panier->descriptionspanier[0]],
                            function ($prev, $dp) {
                                return $prev + $dp->prix * $dp->quantite;
                            },
                            0,
                        ) }} €
                    </p>
                </div>
            </div>
            <div class="buttons">
                <a href="/panier" class="button">Retourner au panier</a>
                <button type="submit" class="button">Confirmer</button>
            </div>
        </form>
    </main>
    @include('layout.footer')
@endsection
