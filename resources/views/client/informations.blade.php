@php
    $active = 'compte';
@endphp

@section('title', 'Informations - Mon Compte - VinoTrip')

@extends('layout.app')

@section('head')
    <link rel="stylesheet" href="/assets/css/client/connexion.css">
@endsection

@section('body')
    @include('layout.header')
    <main class="container-sm">
        @include('layout.breadcrumb')
        <h1>Mes informations personnelles</h1>
        <hr class="separateur-titre" />
        @if (\Session::has('success'))
            <p class="alert alert-success"><i data-lucide="circle-check-big"></i>{!! \Session::get('success') !!}</p>
        @endif
        <div id="informations">
            <form id="modification" class="formulaire" method="post" action="/api/client/edit">
                @csrf

                <div class="groupe-radio">
                    <label>Civilité</label>
                    <div class="radios">
                        <div class="input-control input-control-radio">
                            <input id="civilitemonsieur" type="radio" name="civiliteclient" value="M"
                                {{ old('civiliteclient', Auth::User()->civiliteclient) == 'M' ? 'checked' : '' }} />
                            <label for="civilitemonsieur">M</label>
                        </div>
                        <div class="input-control input-control-radio">
                            <input id="civilitemadame" type="radio" name="civiliteclient" value="Mme"
                                {{ old('civiliteclient', Auth::User()->civiliteclient) == 'Mme' ? 'checked' : '' }} />
                            <label for="civilitemadame">Mme</label>
                        </div>
                        <div class="input-control input-control-radio">
                            <input id="civilitemademoiselle" type="radio" name="civiliteclient" value="Mlle"
                                {{ old('civiliteclient', Auth::User()->civiliteclient) == 'Mlle' ? 'checked' : '' }} />
                            <label for="civilitemademoiselle">Mlle</label>
                        </div>
                    </div>
                </div>

                <div class="input-control input-control-text">
                    <label for="prenomclient">Prénom</label>
                    <input id="prenomclient" type="text" name="prenomclient"
                        value="{{ old('prenomclient', Auth::User()->prenomclient) }}" />
                    @error('prenomclient')
                        <p class="error">Le prénom n'est pas valide !</p>
                    @enderror
                </div>
                <div class="input-control input-control-text">
                    <label for="nomclient">Nom</label>
                    <input id="nomclient" type="text" name="nomclient"
                        value="{{ old('nomclient', Auth::User()->nomclient) }}" />
                    @error('nomclient')
                        <p class="error">Le nom n'est pas valide !</p>
                    @enderror
                </div>
                <div class="input-control input-control-text">
                    <label for="emailclient">Email</label>
                    <input id="emailclient" type="text" name="emailclient"
                        value="{{ old('emailclient', Auth::User()->emailclient) }}" />
                    @error('emailclient')
                        <p class="error">L'adresse email n'est pas valide !</p>
                    @enderror
                </div>

                <div class="input-control input-control-text">
                    <label for="ancienmotdepasse">Mot de passe actuel</label>
                    <input id="ancienmotdepasse" type="password" name="ancienmotdepasse" placeholder="" />
                    @error('ancienmotdepasse')
                        <p class="error">
                            Le mot de passe est invalide !
                        </p>
                    @enderror
                </div>
                <div class="input-control input-control-text">
                    <label for="nouveaumotdepasse">Nouveau mot de passe</label>
                    <input id="nouveaumotdepasse" type="password" name="nouveaumotdepasse" placeholder="" />
                    @error('nouveaumotdepasse')
                        <p class="error">
                            Le format du mot de passe est invalide, il doit contenir : </br>
                            - Au moins une majuscule et minuscule </br>
                            - Au moins un chiffre </br>
                            - Au moins un caractère spécial </br>
                            - Et faire au moins 12 caractères
                        </p>
                    @enderror
                </div>
                <div class="input-control input-control-text">
                    <label for="confirmationmotdepasse">Confirmez le mot de passe</label>
                    <input id="confirmationmotdepasse" type="password" name="confirmationmotdepasse" placeholder="" />
                    @error('confirmationmotdepasse')
                        <p class="error">
                            Les mots de passe ne correspondent pas !
                        </p>
                    @enderror
                </div>

                <div class="input-control input-control-multiselect">
                    <label>Date de naissance</label>

                    <div class="input-selects">
                        <select name="journaissance" id="journaissance">
                            <option selected value="null">-</option>
                            @for ($jour = 1; $jour < 32; $jour++)
                                <option
                                    {{ old('journaissance', substr(Auth::User()->datenaissanceclient, 8, 2)) == $jour ? 'selected' : '' }}
                                    value="{{ $jour }}">
                                    {{ $jour }}</option>
                            @endfor
                        </select>

                        <select name="moisnaissance" id="moisnaissance">
                            <option selected value="null">-</option>
                            @foreach (['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'] as $i => $mois)
                                <option
                                    {{ old('moisnaissance', substr(Auth::User()->datenaissanceclient, 5, 2)) == $i + 1 ? 'selected' : '' }}
                                    value="{{ $i + 1 }}">
                                    {{ $mois }}</option>
                            @endforeach
                        </select>
                        <select name="anneenaissance" id="anneenaissance">
                            <option selected value="null">-</option>
                            @for ($annee = intval(Date('Y')); $annee >= 1900; $annee--)
                                <option
                                    {{ old('anneenaissance', substr(Auth::User()->datenaissanceclient, 0, 4)) == $annee ? 'selected' : '' }}
                                    value="{{ $annee }}">
                                    {{ $annee }}</option>
                            @endfor
                        </select>
                    </div>

                </div>

                <div class="input-control input-control-checkbox">
                    <input type="checkbox" name="offrespromotionnellesclient" id="offrespromotionnellesclient"
                        {{ old('offrespromotionnellesclient', Auth::User()->offrespromotionnellesclient) ? 'checked' : '' }}>
                    <label for="offrespromotionnellesclient">S'inscrire à la newsletter</label>
                </div>

                <input type="submit" value="Enregistrer" class="button" />
            </form>
        </div>
    </main>
    @include('layout.footer')
@endsection
