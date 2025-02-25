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
        <h1>Authentification à deux facteurs</h1>
        <hr class="separateur-titre" />
        @if (\Session::has('success'))
            <p class="alert alert-success"><i data-lucide="circle-check-big"></i>{!! \Session::get('success') !!}</p>
        @endif
        <form class="formulaire" id="a2f-form">
            @csrf
            <div class="input-control input-control-text">
                <label>Numéro de téléphone</label>
                <input type="text" value="+33*******{{ substr($client->telephoneclient, -2) }}" readonly />
            </div>
            <div class="input-control input-control-text hidden" id="a2f-code">
                <label>Code de vérification</label>
                <input type="text" name="code" placeholder="XXXXXX" autocomplete="off" />
                <div class="alert alert-error hidden" id="a2f-code-error"><i data-lucide="circle-x"></i><span class="text"></span></div>
            </div>
            <input type="submit" value="Envoyer le code" class="button" id="button-submit" disabled />
            <button class="button" id="button-cancel" type="button">Annuler</button>
        </form>
    </main>
    @include('layout.footer')
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="/assets/js/client/a2f.js" type="module"></script>
@endsection
