@php
    $active = 'compte';
@endphp

@extends('layout.app')

@section('body')
    @include('layout.header')
    <main class="container-sm">
        <h1>Mes informations personnelles</h1>
        <hr />
        @if (\Session::has('success'))
            <div class="alert alert-success">
                {!! \Session::get('success') !!}
            </div>
        @endif
        <div id="informations">
            <form id="modification" class="formulaire" method="post" action="/api/client/edit">
                @csrf

                <div class="groupe-radio">
                    <label>Civilité</label>
                    <div class="radios">
                        <div class="input-control input-control-radio">
                            <input id="civilitemonsieur" type="radio" name="civiliteclient" value="M"
                                @if (Auth::User()->civiliteclient == 'M') checked @endif />
                            <label for="civilitemonsieur">M</label>
                        </div>
                        <div class="input-control input-control-radio">
                            <input id="civilitemadame" type="radio" name="civiliteclient" value="Mme"
                                @if (Auth::User()->civiliteclient == 'Mme') checked @endif />
                            <label for="civilitemadame">Mme</label>
                        </div>
                        <div class="input-control input-control-radio">
                            <input id="civilitemademoiselle" type="radio" name="civiliteclient" value="Mlle"
                                @if (Auth::User()->civiliteclient == 'Mlle') checked @endif />
                            <label for="civilitemademoiselle">Mlle</label>
                        </div>
                    </div>
                </div>

                <div class="input-control input-control-text">
                    <label for="prenomclient">Prénom</label>
                    <input id="prenomclient" type="text" name="prenomclient" value="{{ Auth::User()->prenomclient }}" />
                    @error('prenomclient')
                        <p class="error">Le prénom n'est pas valide !</p>
                    @enderror
                </div>
                <div class="input-control input-control-text">
                    <label for="nomclient">Nom</label>
                    <input id="nomclient" type="text" name="nomclient" value="{{ Auth::User()->nomclient }}" />
                    @error('nomclient')
                        <p class="error">Le nom n'est pas valide !</p>
                    @enderror
                </div>
                <div class="input-control input-control-text">
                    <label for="emailclient">Email</label>
                    <input id="emailclient" type="text" name="emailclient" value="{{ Auth::User()->emailclient }}" />
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
                                <option @if ($jour == substr(Auth::User()->datenaissanceclient, 8, 2)) selected @endif value="{{ $jour }}">
                                    {{ $jour }}</option>
                            @endfor
                        </select>

                        <select name="moisnaissance" id="moisnaissance">
                            <option selected value="null">-</option>
                            @foreach (['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'] as $i => $mois)
                                <option @if ($i + 1 == substr(Auth::User()->datenaissanceclient, 5, 2)) selected @endif value="{{ $i + 1 }}">
                                    {{ $mois }}</option>
                            @endforeach
                        </select>
                        <select name="anneenaissance" id="anneenaissance">
                            <option selected value="null">-</option>
                            @for ($annee = intval(Date('Y')); $annee >= 1900; $annee--)
                                <option @if ($annee == substr(Auth::User()->datenaissanceclient, 0, 4)) selected @endif value="{{ $annee }}">
                                    {{ $annee }}</option>
                            @endfor
                        </select>
                    </div>

                </div>

                <div class="input-control input-control-checkbox">
                    <input type="checkbox" name="offrespromotionnellesclient" id="offrespromotionnellesclient"
                        @if (Auth::User()->offrespromotionnellesclient) checked @endif>
                    <label for="offrespromotionnellesclient">S'inscrire à la newsletter</label>
                </div>

                <input type="submit" value="Enregistrer" class="button" />
            </form>
        </div>
    </main>
    @include('layout.footer')
@endsection
