@php
    $active = 'compte';
@endphp

@section('title', 'Ajouter Adresse - Mon Compte - VinoTrip')

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
            $breadcrumRemoveLink = ['/client/adresse/'];
            $breadcrumReplaceLink = ['/client/adresse' => '/client/adresses'];
            $breadcrumReplaceName = [
                '/client/adresse' => 'Adresses',
            ];
        @endphp
        @include('layout.breadcrumb')
        @if (Auth::user())
            <h1>Ajouter Adresse</h1>
        @else
            <h1>Ajouter votre première adresse</h1>
        @endif
        <hr class="separateur-titre" />
        @if (\Session::has('success'))
            <p class="alert alert-success"><i data-lucide="circle-check-big"></i>{!! \Session::get('success') !!}</p>
        @endif

        <div id="informations">

            <form id="modification" class="formulaire" method="post"
                action="@if (Auth::user()) {{route('api.adresse.add')}} @else {{route('api.adresse.first')}} @endif">
                @csrf

                @if (!Auth::user())
                    <input type="hidden" name="prenomclient" value="{{ $prenomclient }}">
                    <input type="hidden" name="nomclient" value="{{ $nomclient }}">
                    <input type="hidden" name="emailclient" value="{{ $emailclient }}">
                    <input type="hidden" name="telephoneclient" value="{{ $telephoneclient }}">
                    <input type="hidden" name="motdepasseclient" value="{{ $motdepasseclient }}">
                    @isset($datenaissanceclient)
                        <input type="hidden" name="datenaissanceclient" value="{{ $datenaissanceclient }}">
                    @endisset
                    @isset($offrespromotionnellesclient)
                        <input type="hidden" name="offrespromotionnellesclient" value="{{ $offrespromotionnellesclient }}">
                    @endisset
                    @isset($civiliteclient)
                        <input type="hidden" name="civiliteclient" value="{{ $civiliteclient }}">
                    @endisset
                    @isset($redirect)
                        <input type="hidden" name="redirect" value="{{ $redirect }}">
                    @endisset
                @endif

                <div class="input-control input-control-text required">
                    <label for="nomadresse">Libellé de l'adresse</label>
                    <input id="nomadresse" type="text" name="nomadresse"
                        value="{{ old('nomadresse', Session::get('nomadresse')) }}" />
                    @error('nomadresse')
                        <p class="alert alert-error"><i data-lucide="circle-x"></i>Le nom n'est pas valide !</p>
                    @enderror
                </div>

                <div class="input-control input-control-text required">
                    <label for="nomadressedestinataire">Nom</label>
                    <input id="nomadressedestinataire" type="text" name="nomadressedestinataire"
                        value="{{ old('nomadressedestinataire', Session::get('nomadressedestinataire')) }}" />
                    @error('nomadressedestinataire')
                        <p class="alert alert-error"><i data-lucide="circle-x"></i>Le nom n'est pas valide !</p>
                    @enderror
                </div>

                <div class="input-control input-control-text required">
                    <label for="prenomadressedestinataire">Prénom</label>
                    <input id="prenomadressedestinataire" type="text" name="prenomadressedestinataire"
                        value="{{ old('prenomadressedestinataire', Session::get('prenomadressedestinataire')) }}" />
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

                {{-- Todo : Ajouter caractères spécieaux dans le regex (àéèç....) --}}
                <input id="oldstreet" class='hidden' value="{{ old('rueadresse', Session::get('rueadresse')) }}">
                <div class="input-control input-control-text required">
                    <label>Rue</label>
                    <div id="street" class="address-field autocomplete-container" name="street">

                        @error('rueadresse')
                            <p class="alert alert-error"><i data-lucide="circle-x"></i>La rue n'est pas valide !</p>
                        @enderror
                    </div>
                </div>

                <div class="input-control input-control-text required">
                    <label for="numadresse">Numéro</label>
                    <input id="numadresse" type="text" name="numadresse" class="geoapify-autocomplete-input small-input"
                        value="{{ old('numadresse', Session::get('numadresse')) }}" />
                    @error('numadresse')
                        <p class="alert alert-error"><i data-lucide="circle-x"></i>Le numéro n'est pas valide !</p>
                    @enderror
                </div>

                <div class="input-control input-control-text required">
                    <label for="cpadresse">Code Postal</label>
                    <input id="cpadresse" type="text" name="cpadresse" class="geoapify-autocomplete-input small-input"
                        value="{{ old('cpadresse', Session::get('cpadresse')) }}" />
                    @error('cpadresse')
                        <p class="alert alert-error"><i data-lucide="circle-x"></i>Le code postal n'est pas valide !</p>
                    @enderror
                </div>

                <input id="oldcity" class='hidden' value="{{ old('villeadresse', Session::get('villeadresse')) }}">
                <div class="input-control input-control-text required">
                    <label>Ville</label>
                    <div id="city" type="text" name="city" class="address-field autocomplete-container"
                        value="{{ old('villeadresse', Session::get('villeadresse')) }}" />
                    @error('villeadresse')
                        <p class="alert alert-error"><i data-lucide="circle-x"></i>La ville n'est pas valide !</p>
                    @enderror
                </div>

                <input id="oldcountry" class='hidden' value="{{ old('paysadresse', Session::get('paysadresse')) }}">
                <div class="input-control input-control-text required">
                    <label>Pays</label>
                    <div id="country" type="text" name="country" class="address-field autocomplete-container"
                        value="{{ old('paysadresse', Session::get('paysadresse')) }}" />
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
