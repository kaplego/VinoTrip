@php
    $active = 'compte';
@endphp

@extends('layout.app')

@section('title', 'Connexion - VinoTrip')

@section('head')
    <link rel="stylesheet" href="/assets/css/client/connexion.css">
@endsection

@section('body')
    @include('layout.header')
    <main class="container-sm">
        <h1>Inscription</h1>
        <hr class="separateur-titre" />

        <form id="inscription" class="formulaire" method="post" action="/api/client/signin">
            @csrf

            <div class="groupe-radio">
                <label>Civilité</label>
                <div class="radios">
                    <div class="input-control input-control-radio">
                        <input id="civilitemonsieur" type="radio" name="civiliteclient" value="M" />
                        <label for="civilitemonsieur">M</label>
                    </div>
                    <div class="input-control input-control-radio">
                        <input id="civilitemadame" type="radio" name="civiliteclient" value="Mme" />
                        <label for="civilitemadame">Mme</label>
                    </div>
                    <div class="input-control input-control-radio">
                        <input id="civilitemademoiselle" type="radio" name="civiliteclient" value="Mlle" />
                        <label for="civilitemademoiselle">Mlle</label>
                    </div>
                </div>
            </div>

            <div class="input-control input-control-text">
                <label for="prenomclient">Prénom</label>
                <input id="prenomclient" type="text" name="prenomclient" placeholder="Prenom" />
                @error('prenomclient')
                    <p class="error">Le prénom n'est pas valide !</p>
                @enderror
            </div>
            <div class="input-control input-control-text">
                <label for="nomclient">Nom</label>
                <input id="nomclient" type="text" name="nomclient" placeholder="Nom" />
                @error('nomclient')
                    <p class="error">Le nom n'est pas valide !</p>
                @enderror
            </div>
            <div class="input-control input-control-text">
                <label for="emailinscription">Email</label>
                <input id="emailinscription" type="text" name="emailclient" placeholder="prenom.nom@email.com" />
                @error('emailclient')
                    <p class="error">L'adresse email n'est pas valide !</p>
                @enderror
            </div>
            <div class="input-control input-control-text">
                <label for="motdepasseinscription">Mot de passe</label>
                <input id="motdepasseinscription" type="password" name="motdepasseclient" placeholder="M0tD€p@ss3" />
                @error('motdepasseclient')
                    <p class="error">
                        Le format du mot de passe est invalide, il doit contenir : </br>
                        - Au moins une majuscule et minuscule </br>
                        - Au moins un chiffre </br>
                        - Au moins un caractère spécial </br>
                        - Et faire au moins 12 caractères
                    </p>
                @enderror
            </div>
            <div class="input-control input-control-multiselect">
                <label>Date de naissance</label>

                <div class="input-selects">
                    <select name="journaissance" id="journaissance">
                        <option selected value="null">-</option>
                        @for ($jour = 1; $jour < 32; $jour++)
                            <option value="{{ $jour }}">{{ $jour }}</option>
                        @endfor
                    </select>

                    <select name="moisnaissance" id="moisnaissance">
                        <option selected value="null">-</option>
                        @foreach (['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'] as $i => $mois)
                            <option value="{{ $i + 1 }}">{{ $mois }}</option>
                        @endforeach
                    </select>

                    <select name="anneenaissance" id="anneenaissance">
                        <option selected value="null">-</option>
                        @for ($annee = intval(Date('Y')); $annee >= 1900; $annee--)
                            <option value="{{ $annee }}">{{ $annee }}</option>
                        @endfor
                    </select>
                </div>

            </div>

            <div class="input-control input-control-checkbox">
                <input type="checkbox" name="offrespromotionnellesclient" id="offrespromotionnellesclient">
                <label for="offrespromotionnellesclient">S'inscrire à la newsletter</label>
            </div>

            <input type="submit" value="Inscription" class="button" />
        </form>

        <h1>Connexion</h1>
        <hr class="separateur-titre" />

        <form id="connexion" class="formulaire" method="post" action="/api/client/login">
            @csrf

            <div class="input-control input-control-text">
                @error('login')
                    <p class="error">Le mot de passe ou l'adresse email n'est pas valide !</p></br>
                @enderror

                <label for="emailconnexion">Email</label>
                <input id="emailconnexion" type="text" name="emailclientconnexion" placeholder="prenom.nom@email.com" />
                @error('emailclientconnexion')
                    <p class="error">L'adresse email n'est pas valide !</p>
                @enderror
            </div>
            <div class="input-control input-control-text">
                <label for="motdepasseconnexion">Mot de passe</label>
                <input id="motdepasseconnexion" type="password" name="motdepasseconnexion" placeholder="M0tD€p@ss3" />
                @error('motdepasseconnexion')
                    <p class="error">Le mot de passe n'est pas valide !</p>
                @enderror
            </div>

            <input type="submit" value="Connexion" class="button" />
        </form>
    </main>
    @include('layout.footer')
@endsection
