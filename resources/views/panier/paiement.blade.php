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
        <form action="/api/panier/payment" method="POST" novalidate>
            @csrf
            <div id="paiement">
                <div id="prix">
                    <p class="text">Prix TTC</p>
                    <p class="value">
                        @php
                            $prixTotal = 0;
                            foreach ($panier->descriptionspanier as $dp) {
                                $prixTotal += $dp->prix * $dp->quantite;
                            }
                        @endphp
                        {{ $prixTotal }}
                        €
                    </p>
                </div>
                <div id="client">
                    <p class="name">{{ Auth::user()->nomclient }} {{ Auth::user()->prenomclient }}</p>
                    <div class="input-control input-control-select">
                        <label for="adresse-facturation">Adresse de facturation</label>
                        <select name="adresse-facturation" id="adresse-facturation">
                            @foreach (Auth::user()->adresses as $adresse)
                                <option value="{{ $adresse->idadresse }}" @if (old('adresse-facturation') == $adresse->idadresse) selected @endif>
                                    {{ $adresse->nomdestinataireadresse }} {{ $adresse->prenomdestinataireadresse }} :
                                    {{ $adresse->rueadresse }}
                                    ({{ $adresse->villeadresse }})
                                </option>
                            @endforeach
                        </select>
                        @error('adresse-facturation')
                            <p class="error">{{ $message }}</p>
                        @enderror
                    </div>
                    <p class="name"><a href="/client/adresses" class="link link-icon"><i
                                data-lucide="map-pin-plus"></i>Modifier mes adresses</a></p>
                </div>
                <div id="infos-bancaires">
                    <div class="input-control input-control-select" id="choix-cb">
                        <label for="carte-bancaire">Choix de la carte bancaire</label>
                        <select name="carte-bancaire" id="carte-bancaire">
                            <option value="new">Utiliser une autre carte bancaire</option>
                        </select>
                        @error('carte-bancaire')
                            <p class="error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="input-group">
                        <div class="input-control input-control-text">
                            <label for="cb-nom">Titulaire de la carte bancaire</label>
                            <input type="text" id="cb-nom" name="cb-nom" autocomplete="cc-name" required
                                placeholder="{{ Auth::user()->nomclient }} {{ Auth::user()->prenomclient }}"
                                value="{{ old('cb-nom') }}" />
                            @error('cb-nom')
                                <p class="error">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="input-control input-control-text">
                            <label for="numero-cb">Numéro de carte bancaire</label>
                            <input type="text" id="numero-cb" name="numero-cb" autocomplete="cc-number" required
                                placeholder="xxxx xxxx xxxx xxxx" value="{{ old('numero-cb') }}" />
                            @error('numero-cb')
                                <p class="error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="input-group">
                        <div class="input-control input-control-text">
                            <label for="ccv-cb">Code de sécurité</label>
                            <input type="text" id="ccv-cb" name="ccv-cb" autocomplete="cc-number" required
                                placeholder="xxx" value="{{ old('ccv-cb') }}" />
                            @error('ccv-cb')
                                <p class="error">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="input-control input-control-select">
                            <label for="cb-exp-mois">Mois d'expiration</label>
                            <select name="cb-exp-mois" id="cb-exp-mois" autocomplete="cc-exp-month" required>
                                <option selected disabled value="null">-</option>
                                @foreach (['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'] as $i => $mois)
                                    <option value="{{ $i + 1 }}" @if (old('cb-exp-mois') == $i + 1) selected @endif>
                                        {{ $mois }}</option>
                                @endforeach
                            </select>
                            @error('cb-exp-mois')
                                <p class="error">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="input-control input-control-select">
                            <label for="cb-exp-annee">Année d'expiration</label>
                            <select name="cb-exp-annee" id="cb-exp-annee" autocomplete="cc-exp-year" required>
                                <option selected disabled value="null">-</option>
                                @for ($annee = intval(Date('Y')); $annee <= intval(Date('Y')) + 20; $annee++)
                                    <option value="{{ $annee }}" @if (old('cb-exp-annee') == $annee) selected @endif>
                                        {{ $annee }}</option>
                                @endfor
                            </select>
                            @error('cb-exp-annee')
                                <p class="error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="input-control input-control-checkbox">
                        <input type="checkbox" name="save-infos-cb" id="save-infos-cb" value="1">
                        <label for="save-infos-cb">Enregistrer les informations de la carte bancaire</label>
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
