@php
    $active = 'compte';
@endphp

@extends('layout.app')

@section('body')
    @include('layout.header')
    <main class="container-sm">
        <h1>Mon Compte</h1>
        <hr />
        <div id="profil">
            <form method="get" action="/profil/informations">
                <button type="submit">
                    Mes informations personnelles
                </button>
            </form>
            <form method="post" action="/api/client/logout">
                @csrf
                <button type="submit">
                    Deconnexion
                </button>
            </form>
        </div>
    </main>
    @include('layout.footer')
@endsection
