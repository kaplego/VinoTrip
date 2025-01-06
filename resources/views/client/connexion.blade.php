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
        @include('layout.breadcrumb')

        @if (session('password_success'))
            <div class="alert alert-success">
                <i data-lucide="circle-check-big"></i>
                <span>{{ session('password_success') }}</span>
            </div>
        @endif

        <div id="conteneur">
            <div>
                <h1>Inscription</h1>
                <hr class="separateur-titre" />

                <form id="inscription" class="formulaire" method="post" action="/api/client/signin">
                    @csrf

                    @isset($redirect)
                        <input type="hidden" name="redirect" value="{{ $redirect }}">
                    @endisset

                    <div class="groupe-radio">
                        <label>Civilité</label>
                        <div class="radios">
                            <div class="input-control input-control-radio">
                                <input id="civilitemonsieur" type="radio" name="civiliteclient" value="M"
                                    autocomplete="off" {{ old('civiliteclient') === 'M' ? 'checked' : '' }} />
                                <label for="civilitemonsieur">M</label>
                            </div>
                            <div class="input-control input-control-radio">
                                <input id="civilitemadame" type="radio" name="civiliteclient" value="Mme"
                                    autocomplete="off" {{ old('civiliteclient') === 'Mme' ? 'checked' : '' }} />
                                <label for="civilitemadame">Mme</label>
                            </div>
                            <div class="input-control input-control-radio">
                                <input id="civilitemademoiselle" type="radio" name="civiliteclient" value="Mlle"
                                    autocomplete="off" {{ old('civiliteclient') === 'Mlle' ? 'checked' : '' }} />
                                <label for="civilitemademoiselle">Mlle</label>
                            </div>
                        </div>
                    </div>

                    <div class="input-control input-control-text">
                        <label for="prenomclient">Prénom</label>
                        <input id="prenomclient" type="text" name="prenomclient" placeholder="Prenom"
                            autocomplete="given-name" value="{{ old('prenomclient') }}" />
                        @error('prenomclient')
                            <p class="alert alert-error"><i data-lucide="circle-x"></i>Le prénom n'est pas valide !</p>
                        @enderror
                    </div>
                    <div class="input-control input-control-text">
                        <label for="nomclient">Nom</label>
                        <input id="nomclient" type="text" name="nomclient" placeholder="Nom" autocomplete="family-name"
                            value="{{ old('nomclient') }}" />
                        @error('nomclient')
                            <p class="alert alert-error"><i data-lucide="circle-x"></i>Le nom n'est pas valide !</p>
                        @enderror
                    </div>
                    <div class="input-control input-control-text">
                        <label for="emailinscription">Email</label>
                        <input id="emailinscription" type="text" name="emailclient" autocomplete="email"
                            placeholder="prenom.nom@email.com" value="{{ old('emailclient') }}" />
                        @error('emailclient')
                            <p class="alert alert-error"><i data-lucide="circle-x"></i>L'adresse email n'est pas valide !</p>
                        @enderror
                    </div>
                    <div class="input-control input-control-text">
                        <label for="telephoneclient">Numéro de téléphone</label>
                        <input id="telephoneclient" type="text" name="telephoneclient" autocomplete="telephoneclient"
                            placeholder="0102030405" value="{{ old('telephoneclient') }}" />
                        @error('telephoneclient')
                            <p class="alert alert-error"><i data-lucide="circle-x"></i>Le numéro de téléphone n'est pas valide !
                            </p>
                        @enderror
                    </div>
                    <div class="input-control input-control-text">
                        <label for="motdepasseinscription">Mot de passe</label>
                        <input id="motdepasseinscription" type="password" name="motdepasseclient"
                            autocomplete="new-password" placeholder="M0tD€p@ss3" />
                        @error('motdepasseclient')
                            <p class="alert alert-error"><i data-lucide="circle-x"></i>
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
                            <select name="journaissance" id="journaissance" autocomplete="bday-day">
                                <option selected value="null">-</option>
                                @for ($jour = 1; $jour < 32; $jour++)
                                    <option value="{{ $jour }}"
                                        {{ old('journaissance') == $jour ? 'selected' : '' }}>
                                        {{ $jour }}</option>
                                @endfor
                            </select>

                            <select name="moisnaissance" id="moisnaissance" autocomplete="bday-month">
                                <option selected value="null">-</option>
                                @foreach (['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'] as $i => $mois)
                                    <option value="{{ $i + 1 }}"
                                        {{ old('moisnaissance') == $i + 1 ? 'selected' : '' }}>
                                        {{ $mois }}</option>
                                @endforeach
                            </select>

                            <select name="anneenaissance" id="anneenaissance" autocomplete="bday-year">
                                <option selected value="null">-</option>
                                @for ($annee = intval(Date('Y')); $annee >= 1900; $annee--)
                                    <option value="{{ $annee }}"
                                        {{ old('anneenaissance') == $annee ? 'selected' : '' }}>
                                        {{ $annee }}</option>
                                @endfor
                            </select>
                        </div>
                        @error('datenaissanceclient')
                            <p class="alert alert-error"><i data-lucide="circle-x"></i>
                                L'utilisateur doit être majeur !
                            </p>
                        @enderror

                    </div>

                    <div class="input-control input-control-checkbox">
                        <input type="checkbox" name="offrespromotionnellesclient" id="offrespromotionnellesclient"
                            value="1">
                        <label for="offrespromotionnellesclient">S'inscrire à la newsletter</label>
                    </div>

                    <input type="submit" value="Inscription" class="button" />
                </form>
            </div>

            <div>
                <h1>Connexion</h1>
                <hr class="separateur-titre" />

                <form id="connexion" class="formulaire" method="post" action="/api/client/login">
                    @csrf

                    @isset($redirect)
                        <input type="hidden" name="redirect" value="{{ $redirect }}">
                    @endisset

                    <div class="input-control input-control-text">
                        @error('login')
                            <p class="alert alert-error"><i data-lucide="circle-x"></i>Le mot de passe ou l'adresse email
                                n'est
                                pas
                                valide !</p></br>
                        @enderror

                        <label for="emailconnexion">Email</label>
                        <input id="emailconnexion" type="text" name="emailclientconnexion"
                            placeholder="prenom.nom@email.com" />
                        @error('emailclientconnexion')
                            <p class="alert alert-error"><i data-lucide="circle-x"></i>L'adresse email n'est pas valide !</p>
                        @enderror
                    </div>
                    <div class="input-control input-control-text">
                        <label for="motdepasseconnexion">Mot de passe</label>
                        <input id="motdepasseconnexion" type="password" name="motdepasseconnexion"
                            autocomplete="current-password" placeholder="M0tD€p@ss3" />
                        @error('motdepasseconnexion')
                            <p class="alert alert-error"><i data-lucide="circle-x"></i>Le mot de passe n'est pas valide !</p>
                        @enderror
                        <a class="link" id="forgot-password">Mot de passe oublié ?</a>
                    </div>
                    <input type="submit" value="Connexion" class="button" />
                </form>

                <form id="reset-password" class="hidden" method="post" action="/api/client/resetmdp">
                    @csrf
                    <h3>Réinitialisation du mot de passe</h3>
                    <div class="input-control input-control-text">
                        <label for="reset_email">Adresse E-mail</label>
                        <input type="email" name="email" id="reset_email" required
                            placeholder="prenom.nom@email.com">
                    </div>
                    <button type="submit" class="button">Envoyer le lien de réinitialisation</button>
                </form>
            </div>
        </div>
    </main>

    @include('layout.footer')
@endsection

@section('scripts')
    <script src="/assets/js/client/connexion.js"></script>
@endsection
