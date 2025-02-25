@php
    $active = 'compte';
@endphp

@section('title', 'Informations - Mon Compte - VinoTrip')

@extends('layout.app')

@section('head')
    <link rel="stylesheet" href="/assets/css/client/connexion.css">
    <link rel="stylesheet" href="/assets/css/client/informations.css">
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
            <form id="modification" class="formulaire" method="post" action="{{ route('api.client-edit') }}">
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
                    </div>
                </div>

                <div class="input-control input-control-text required">
                    <label for="prenomclient">Prénom</label>
                    <input id="prenomclient" type="text" name="prenomclient"
                        value="{{ old('prenomclient', Auth::User()->prenomclient) }}" />
                    @error('prenomclient')
                        <p class="alert alert-error"><i data-lucide="circle-x"></i>Le prénom n'est pas valide !</p>
                    @enderror
                </div>
                <div class="input-control input-control-text required">
                    <label for="nomclient">Nom</label>
                    <input id="nomclient" type="text" name="nomclient"
                        value="{{ old('nomclient', Auth::User()->nomclient) }}" />
                    @error('nomclient')
                        <p class="alert alert-error"><i data-lucide="circle-x"></i>Le nom n'est pas valide !</p>
                    @enderror
                </div>
                <div class="input-control input-control-text required">
                    <label for="emailclient">Email</label>
                    <input id="emailclient" type="text" name="emailclient"
                        value="{{ old('emailclient', Auth::User()->emailclient) }}" />
                    @error('emailclient')
                        <p class="alert alert-error"><i data-lucide="circle-x"></i>L'adresse email n'est pas valide !</p>
                    @enderror
                </div>
                <div class="input-control input-control-text required">
                    <label for="telephoneclient">Numéro de téléphone</label>
                    <input id="telephoneclient" type="text" name="telephoneclient"
                        value="{{ old('telephoneclient', Auth::User()->telephoneclient) }}" />
                    @error('telephoneclient')
                        <p class="alert alert-error"><i data-lucide="circle-x"></i>Le numéro de téléphone n'est pas valide !</p>
                    @enderror
                </div>

                <div class="input-control input-control-text required">
                    <label for="ancienmotdepasse">Mot de passe actuel</label>
                    <input id="ancienmotdepasse" type="password" name="ancienmotdepasse" placeholder="" />
                    @error('ancienmotdepasse')
                        <p class="alert alert-error"><i data-lucide="circle-x"></i>
                            Le mot de passe est invalide !
                        </p>
                    @enderror
                </div>
                <div class="input-control input-control-text">
                    <label for="nouveaumotdepasse">Nouveau mot de passe</label>
                    <input id="nouveaumotdepasse" type="password" name="nouveaumotdepasse" placeholder="" />
                    @error('nouveaumotdepasse')
                        <p class="alert alert-error"><i data-lucide="circle-x"></i>
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
                        <p class="alert alert-error"><i data-lucide="circle-x"></i>
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
                    @error('datenaissanceclient')
                    <p class="alert alert-error"><i data-lucide="circle-x"></i>
                        L'utilisateur doit être majeur !
                    </p>
                    @enderror

                </div>

                <div class="input-control input-control-checkbox">
                    <input type="checkbox" name="offrespromotionnellesclient" id="offrespromotionnellesclient"
                        {{ old('offrespromotionnellesclient', Auth::User()->offrespromotionnellesclient) ? 'checked' : '' }}>
                    <label for="offrespromotionnellesclient">S'inscrire à la newsletter</label>
                </div>

                <input type="submit" value="Enregistrer" class="button" />
            </form>
            <h1>Gérer mes données personnelles</h1>
            <hr class="separateur-titre" />
            <p>
                Si vous souhaitez envoyer, supprimer ou anonymiser vos données personnelles, vous pouvez effectuer une demande ci-dessous.
                Veuillez noter que la suppression et l'anonymisation de vos données sont irréversibles.
            </p>
            <div id="buttons-donnees-perso">
                <form method="post" action="{{ route('api.client-supprimer') }}">
                    @csrf
                    <button type="submit" class="button" onclick="return confirm('Êtes-vous sûr de vouloir supprimer vos informations ? Cette action est irréversible.')">
                        Demander la suppression de mes informations
                    </button>
                </form>

                <form method="post" action="{{ route('api.client-anonymiser') }}">
                    @csrf
                    <button type="submit" class="button" onclick="return confirm('Êtes-vous sûr de vouloir anonymiser vos informations ? Cette action est irréversible.')">
                        Demander l’anonymisation de mes informations
                    </button>
                </form>
                <form method="post" action="{{ route('api.client-data') }}">
                    @csrf
                    <button type="submit" class="button">Demander mes informations personnelles</button>
                </form>
            </div>
        </div>
    </main>
    @include('layout.footer')
@endsection
