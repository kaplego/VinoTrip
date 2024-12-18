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
        <h1>Définir un nouveau mot de passe</h1>
        <hr class="separateur-titre" />

        <form id="inscription" class="formulaire" method="post" action="/api/client/mdpreset/{{$token}}">
            @csrf

            <div class="input-control input-control-text">
                <label for="motdepasseclient">Nouveau mot de passe</label>
                <input id="motdepasseclient" type="password" name="motdepasseclient" autocomplete="new-password"
                    placeholder="M0tD€p@ss3" required />
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

            <div class="input-control input-control-text">
                <label for="confirmationmotdepasse">Confirmer le mot de passe</label>
                <input id="confirmationmotdepasse" type="password" name="confirmationmotdepasse" autocomplete="new-password"
                    placeholder="M0tD€p@ss3" required />
                @error('confirmationmotdepasse')
                    <p class="alert alert-error"><i data-lucide="circle-x"></i>
                        Les mots de passe ne correspondent pas.
                    </p>
                @enderror
            </div>
            </div>
            <input type="submit" value="Réinitialiser" class="button" />


        </main>


    @include('layout.footer')
@endsection

