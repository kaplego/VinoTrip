@php
    $active = 'compte';
@endphp

@extends('layout.app')

@section('title', 'Mon Compte - VinoTrip')

@section('head')
    <link rel="stylesheet" href="/assets/css/client/compte.css">
@endsection

@section('body')
    @include('layout.header')
    <main class="container-sm">
        @include('layout.breadcrumb')
        <h1>Mon Compte</h1>
        <hr class="separateur-titre" />
        <div class="buttons buttons-advanced">
            <a class="button" href="/client/informations">
                <i data-lucide="id-card"></i>
                <span class="text">Informations</span>
                <span class="details">Email, tél, mot de passe</span>
            </a>
            <a class="button" href="/client/securite">
                <i data-lucide="lock"></i>
                <span class="text">Sécurité</span>
                <span class="details">A2F</span>
            </a>
            <form method="post" action="/api/client/logout">
                @csrf
                <button class="button" type="submit">
                    <i data-lucide="log-out"></i>
                    <span class="text">Deconnexion</span>
                </button>
            </form>
            <a class="button" href="/client/adresses">
                <i data-lucide="map-pin-house"></i>
                <span class="text">Mes adresses ({{ $nombreadresses }})</span>
            </a>
            <a class="button" href="/client/commandes">
                <i data-lucide="logs"></i>
                <span class="text">Mes commandes ({{ $nombrecommandes }})</span>
            </a>
            <a class="button" href="/client/favoris">
                <i data-lucide="heart"></i>
                <span class="text">Mes favoris ({{ $nombrefavoris }})</span>
            </a>
        </div>
        @if (Helpers::AuthIsRole(Role::Dirigeant))
            <hr class="separateur-titre" />
            <div class="buttons buttons-advanced">
                <a class="button" href="/sejours/create">
                    <i data-lucide="image-plus"></i>
                    <span class="text">Créer un séjour</span>
                </a>
                <a class="button" href="/sejours/validate">
                    <i data-lucide="key-square"></i>
                    <span class="text">Séjours non publiés</span>
                </a>
            </div>
        @endif

        @if (Helpers::AuthIsRole(Role::ServiceVente))
            <hr class="separateur-titre" />
            <div class="buttons buttons-advanced">
                <a class="button" href="/sejours/validate">
                    <i data-lucide="key-square"></i>
                    <span class="text">Séjours non publiés</span>
                </a>
            </div>
        @endif

        @if (Helpers::AuthIsRole(Role::DPO))
            <hr class="separateur-titre" />
            <form method="post" action="/api/client/rgpd">
                @csrf
                <button type="submit" class="button">Anonymiser les données</button>
            </form>
        @endif
    </main>
    @include('layout.footer')
@endsection
