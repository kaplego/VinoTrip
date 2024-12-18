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
        <div id="account">
            <a class="button" href="/client/informations">
                Mes informations personnelles
            </a>
            <a class="button" href="/client/adresses">
                Mes adresses
            </a>
            <a class="button" href="/client/commandes">
                Mes commandes
            </a>
            <form method="post" action="/api/client/logout">
                @csrf
                <button class="button" type="submit">
                    Deconnexion
                </button>
            </form>
        </div>
    </main>
    @include('layout.footer')
@endsection
