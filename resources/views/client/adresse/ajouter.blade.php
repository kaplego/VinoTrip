@php
    $active = 'compte';
@endphp

@section('title', 'Ajouter Adresse - Mon Compte - VinoTrip')

@extends('layout.app')

@section('head')
    <link rel="stylesheet" href="/assets/css/client/connexion.css">
@endsection

@section('body')
    @include('layout.header')
    <main class="container-sm">
        @php
            $breadcrumRemoveLink = ["/client/adresse/"];
            $breadcrumReplaceLink = ['/client/adresse' => '/client/adresses'];
            $breadcrumReplaceName = [
                '/client/adresse' => 'Adresses',
            ];
        @endphp
        @include('layout.breadcrumb')
        <h1>Ajouter Adresse</h1>
        <hr class="separateur-titre" />
        @if (\Session::has('success'))
            <p class="alert alert-success"><i data-lucide="circle-check-big"></i>{!! \Session::get('success') !!}</p>
        @endif
        <div id="informations">
            @if(Auth::user())
            <form id="modification" class="formulaire" method="post" action="/api/client/adresse/add">
            @else
            <form id="modification" class="formulaire" method="post" action="/api/client/adresse/firstaddress">
            @endif
                @csrf

                @isset($prenomclient)
                    <input type="hidden" name="prenomclient" value="{{ old('prenomclient', $prenomclient) }}">
                @endisset
                @isset($nomclient)
                    <input type="hidden" name="nomclient" value="{{ $nomclient }}">
                @endisset
                @isset($emailclient)
                    <input type="hidden" name="emailclient" value="{{ $emailclient }}">
                @endisset
                @isset($motdepasseclient)
                    <input type="hidden" name="motdepasseclient" value="{{ $motdepasseclient }}">
                @endisset
                @isset($datenaissance)
                    <input type="hidden" name="datenaissance" value="{{ $datenaissance }}">
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

                <div class="input-control input-control-text">
                    <label for="nomadresse">Libellé de l'adresse</label>
                    <input id="nomadresse" type="text" name="nomadresse"
                        value="{{ old('nomadresse') }}" />
                    @error('nomadresse')
                        <p class="alert alert-error"><i data-lucide="circle-x"></i>Le nom n'est pas valide !</p>
                    @enderror
                </div>

                <div class="input-control input-control-text">
                    <label for="nomadressedestinataire">Nom</label>
                    <input id="nomadressedestinataire" type="text" name="nomadressedestinataire"
                        value="{{ old('nomadressedestinataire') }}" />
                    @error('nomadressedestinataire')
                        <p class="alert alert-error"><i data-lucide="circle-x"></i>Le nom n'est pas valide !</p>
                    @enderror
                </div>

                <div class="input-control input-control-text">
                    <label for="prenomadressedestinataire">Prénom</label>
                    <input id="prenomadressedestinataire" type="text" name="prenomadressedestinataire"
                        value="{{ old('prenomadressedestinataire') }}" />
                    @error('prenomadressedestinataire')
                        <p class="alert alert-error"><i data-lucide="circle-x"></i>Le prénom n'est pas valide !</p>
                    @enderror
                </div>

                <div class="input-control input-control-text">
                    <label for="rueadresse">Rue</label>
                    <input id="rueadresse" type="text" name="rueadresse"
                        value="{{ old('rueadresse') }}" />
                    @error('rueadresse')
                        <p class="alert alert-error"><i data-lucide="circle-x"></i>La rue n'est pas valide !</p>
                    @enderror
                </div>

                <div class="input-control input-control-text">
                    <label for="cpadresse">Code Postal</label>
                    <input id="cpadresse" type="text" name="cpadresse"
                        value="{{ old('cpadresse') }}" />
                    @error('cpadresse')
                        <p class="alert alert-error"><i data-lucide="circle-x"></i>Le code postal n'est pas valide !</p>
                    @enderror
                </div>

                <div class="input-control input-control-text">
                    <label for="villeadresse">Ville</label>
                    <input id="villeadresse" type="text" name="villeadresse"
                        value="{{ old('villeadresse') }}" />
                    @error('villeadresse')
                        <p class="alert alert-error"><i data-lucide="circle-x"></i>La ville n'est pas valide !</p>
                    @enderror
                </div>

                <div class="input-control input-control-text">
                    <label for="paysadresse">Pays</label>
                    <input id="paysadresse" type="text" name="paysadresse"
                        value="{{ old('paysadresse') }}" />
                    @error('paysadresse')
                        <p class="alert alert-error"><i data-lucide="circle-x"></i>Le pays n'est pas valide !</p>
                    @enderror
                </div>

                <input type="submit" value="Enregistrer" class="button" />
            </form>
        </div>
    </main>
    @include('layout.footer')
@endsection
