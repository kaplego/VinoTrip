@php
    $active = 'compte';
@endphp

@section('title', 'Informations - Mon Compte - VinoTrip')

@extends('layout.app')

@section('head')
    <link rel="stylesheet" href="/assets/css/client/securite.css">
@endsection

@section('body')
    @include('layout.header')
    <main class="container-sm">
        @include('layout.breadcrumb')
        <h1>Authentification à double facteurs</h1>
        <hr class="separateur-titre" />
        @if (\Session::has('success'))
            <p class="alert alert-success"><i data-lucide="circle-check-big"></i>{!! \Session::get('success') !!}</p>
        @endif
        <form class="formulaire" method="post" action="/api/client/autha2f">
            @csrf
            <div class="input-control input-control-text">
                <label>Numéro de téléphone</label>
                <input type="text" value="+33{{ substr(Auth::user()->telephoneclient, 1) }}" name="phone" readonly />
                <a href="/client/informations" class="link">Modifier mon numéro de téléphone.</a>
                @error('phone')
                    <div class="alert alert-error"><i data-lucide="circle-x"></i>{{ $message }}</div>
                @enderror
            </div>
            <input type="submit"
                @if (Auth::user()->a2f) value="Désactiver l'A2F" @else value="Activer l'A2F" @endif
                class="button" />
        </form>
    </main>
    @include('layout.footer')
@endsection
