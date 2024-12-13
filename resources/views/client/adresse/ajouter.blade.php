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
            <form id="modification" class="formulaire" method="post" action="/api/client/adresse/add">
                @csrf

                <div class="input-control input-control-text">
                    <label for="nomadresse">Libellé de l'adresse</label>
                    <input id="nomadresse" type="text" name="nomadresse"
                        value="{{ old('nomadresse') }}" />
                    @error('nomadresse')
                        <p class="error">Le nom n'est pas valide !</p>
                    @enderror
                </div>

                <div class="input-control input-control-text">
                    <label for="nomdestinataireadresse">Nom</label>
                    <input id="nomdestinataireadresse" type="text" name="nomdestinataireadresse"
                        value="{{ old('nomdestinataireadresse') }}" />
                    @error('nomdestinataireadresse')
                        <p class="error">Le nom n'est pas valide !</p>
                    @enderror
                </div>

                <div class="input-control input-control-text">
                    <label for="prenomdestinataireadresse">Prénom</label>
                    <input id="prenomdestinataireadresse" type="text" name="prenomdestinataireadresse"
                        value="{{ old('prenomdestinataireadresse') }}" />
                    @error('prenomdestinataireadresse')
                        <p class="error">Le prénom n'est pas valide !</p>
                    @enderror
                </div>

                <div class="input-control input-control-text">
                    <label for="rueadresse">Rue</label>
                    <input id="rueadresse" type="text" name="rueadresse"
                        value="{{ old('rueadresse') }}" />
                    @error('rueadresse')
                        <p class="error">La rue n'est pas valide !</p>
                    @enderror
                </div>

                <div class="input-control input-control-text">
                    <label for="cpadresse">Code Postal</label>
                    <input id="cpadresse" type="text" name="cpadresse"
                        value="{{ old('cpadresse') }}" />
                    @error('cpadresse')
                        <p class="error">Le code postal n'est pas valide !</p>
                    @enderror
                </div>

                <div class="input-control input-control-text">
                    <label for="villeadresse">Ville</label>
                    <input id="villeadresse" type="text" name="villeadresse"
                        value="{{ old('villeadresse') }}" />
                    @error('villeadresse')
                        <p class="error">La ville n'est pas valide !</p>
                    @enderror
                </div>

                <div class="input-control input-control-text">
                    <label for="paysadresse">Pays</label>
                    <input id="paysadresse" type="text" name="paysadresse"
                        value="{{ old('paysadresse') }}" />
                    @error('paysadresse')
                        <p class="error">Le pays n'est pas valide !</p>
                    @enderror
                </div>

                <input type="submit" value="Enregistrer" class="button" />
            </form>
        </div>
    </main>
    @include('layout.footer')
@endsection
