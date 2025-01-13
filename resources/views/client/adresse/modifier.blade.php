@php
    $active = 'compte';
@endphp

@section('title', 'Modification Adresse - Mon Compte - VinoTrip')

@extends('layout.app')

@section('head')
    <script src="https://unpkg.com/@geoapify/geocoder-autocomplete@^1/dist/index.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/@geoapify/geocoder-autocomplete@^1/styles/minimal.css">
    <link rel="stylesheet" href="/assets/css/client/connexion.css">
@endsection

@section('body')
    @include('layout.header')
    <main class="container-sm">
        @php
            $breadcrumRemoveLink = ["/client/adresse/$adresse->idadresse"];
            $breadcrumReplaceLink = ['/client/adresse' => '/client/adresses'];
            $breadcrumReplaceName = [
                '/client/adresse' => 'Adresses',
                "/client/adresse/$adresse->idadresse/modifier" => $adresse->nomadresse,
            ];
        @endphp
        @include('layout.breadcrumb')
        <h1>Modification Adresse</h1>
        <hr class="separateur-titre" />
        @if (\Session::has('success'))
            <p class="alert alert-success"><i data-lucide="circle-check-big"></i>{!! \Session::get('success') !!}</p>
        @endif
        <div id="informations">
            <form id="modification" class="formulaire" method="post" action="/api/client/adresse/modifier">
                @csrf



                <input id="idadresse" class="hidden" type="text" name="idadresse"
                value="{{ old('idadresse', $adresse->idadresse) }}">

                <div class="input-control input-control-text">
                    <label for="nomadresse">Libellé de l'adresse</label>
                    <input id="nomadresse" type="text" name="nomadresse"
                        value="{{ old('nomadresse', $adresse->nomadresse) }}" />
                    @error('nomadresse')
                    <p class="alert alert-error"><i data-lucide="circle-x"></i>Le nom n'est pas valide !</p>
                    @enderror
                </div>

                <div class="input-control input-control-text">
                    <label for="nomadressedestinataire">Nom</label>
                    <input id="nomadressedestinataire" type="text" name="nomadressedestinataire"
                    value="{{ old('nomadressedestinataire', $adresse->nomadressedestinataire) }}">
                    @error('nomadressedestinataire')
                    <p class="alert alert-error"><i data-lucide="circle-x"></i>Le nom n'est pas valide !</p>
                    @enderror
                </div>

                <div class="input-control input-control-text">
                    <label for="prenomadressedestinataire">Prénom</label>
                    <input id="prenomadressedestinataire" type="text" name="prenomadressedestinataire"
                    value="{{ old('prenomadressedestinataire', $adresse->prenomadressedestinataire) }}">
                    @error('prenomadressedestinataire')
                    <p class="alert alert-error"><i data-lucide="circle-x"></i>Le prénom n'est pas valide !</p>
                    @enderror
                </div>

                <div class="hidden">
                    <div id="state" class="address-field autocomplete-container"></div>
                    <input id="rueadresse" name="rueadresse">
                    <input id="villeadresse" name="villeadresse">
                    <input id="paysadresse" name="paysadresse">
                </div>

                <input id="oldstreet" class='hidden' value="{{ old('rueadresse', $adresse->rueadresse) }}">
                <div class="input-control input-control-text">
                    <label>Rue</label>
                    <div id="street" class="address-field autocomplete-container" name="street">
                        @error('rueadresse')
                            <p class="alert alert-error"><i data-lucide="circle-x"></i>La rue n'est pas valide !</p>
                        @enderror
                    </div>
                </div>

                <div class="input-control input-control-text">
                    <label for="numadresse">Numéro</label>
                    <input id="numadresse" type="text" name="numadresse" class="geoapify-autocomplete-input small-input"
                        value="{{ old('numadresse', $adresse->numadresse) }}" />
                    @error('numadresse')
                        <p class="alert alert-error"><i data-lucide="circle-x"></i>Le numéro n'est pas valide !</p>
                    @enderror
                </div>

                <div class="input-control input-control-text">
                    <label for="cpadresse">Code Postal</label>
                    <input id="cpadresse" type="text" name="cpadresse" class="geoapify-autocomplete-input small-input"
                        value="{{ old('cpadresse', $adresse->cpadresse) }}" />
                    @error('cpadresse')
                        <p class="alert alert-error"><i data-lucide="circle-x"></i>Le code postal n'est pas valide !</p>
                    @enderror
                </div>

                <input id="oldcity" class='hidden' value="{{ old('villeadresse', $adresse->villeadresse) }}">
                <div class="input-control input-control-text">
                    <label>Ville</label>
                    <div id="city" type="text" name="city" class="address-field autocomplete-container" />
                    @error('villeadresse')
                        <p class="alert alert-error"><i data-lucide="circle-x"></i>La ville n'est pas valide !</p>
                    @enderror
                </div>

                <input id="oldcountry" class='hidden' value="{{ old('paysadresse', $adresse->paysadresse) }}">
                <div class="input-control input-control-text">
                    <label>Pays</label>
                    <div id="country" type="text" name="country" class="address-field autocomplete-container" />
                    @error('paysadresse')
                        <p class="alert alert-error"><i data-lucide="circle-x"></i>Le pays n'est pas valide !</p>
                    @enderror
                </div>
                <div id="message"></div>
                <input value="Enregistrer" class="button" id="submit" />
            </form>
        </div>
    </main>
    @include('layout.footer')
@endsection

@section('scripts')
    <script src="/assets/js/geoapify/autocomplete.js"></script>
@endsection
