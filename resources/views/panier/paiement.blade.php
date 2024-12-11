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
        @include('layout.breadcrumb')
        <h1>Paiement</h1>
        <hr class="separateur-titre" />
        <form>
            <div id="paiement">
                <div id="prix">
                    <p class="text">Prix TTC</p>
                    <p class="value">
                        {{ array_reduce(
                            array($panier->descriptionspanier[0]),
                            function ($prev, $dp) {
                                return $prev + $dp->prix * $dp->quantite;
                            },
                            0,
                        ) }} €
                    </p>
                </div>
                <div id="client">
                    <p class="name">{{ Auth::user()->nomclient }} {{ Auth::user()->prenomclient }}</p>
                    <label for="adresse-facturation">Adresse de facturation</label>
                    <select name="adresse-facturation" id="adresse-facturation">
                        @foreach (Auth::user()->adresses as $adresse)
                            <option value="{{ $adresse->idadresse }}">{{ $adresse->rueadresse }} ({{ $adresse->villeadresse }})</option>
                        @endforeach
                    </select>
                </div>
                <div id="infos-bancaires">
                    <div class="input-control input-control-text">
                        <label for="numero-cb">Numéro de carte bancaire</label>
                        <input type="text" id="numero-cb" name="numero-cb" />
                    </div>
                </div>
            </div>
            <div id="buttons-navigation">
                <a href="/panier" class="button">Retourner au panier</a>
                <button type="submit" class="button">Confirmer</button>
            </div>
        </form>
    </main>
    @include('layout.footer')
@endsection
