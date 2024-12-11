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
        <div id="profil">
            <form method="get" action="/profil/informations">
                <button class="button" type="submit">
                    Mes informations personnelles
                </button>
            </form>
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
