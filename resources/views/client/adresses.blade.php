@php
    $active = 'compte';
@endphp

@section('title', 'Adresses - Mon Compte - VinoTrip')

@extends('layout.app')

@section('head')
    <link rel="stylesheet" href="/assets/css/client/adresses.css">
@endsection

@section('body')
    @include('layout.header')
    <main class="container">
        @include('layout.breadcrumb')
        <h1>Mes adresses</h1>
        <hr class="separateur-titre" />
        @if (\Session::has('success'))
            <p class="alert alert-success"><i data-lucide="circle-check-big"></i>{!! \Session::get('success') !!}</p>
        @endif
        <div id="explication">
            <p>
                Choisissez vos adresses de facturation et de livraison.
                Ces dernières seront présélectionnées lors de vos commandes.
                Vous pouvez également ajouter d'autres adresses, ce qui est particulièrement intéressant pour envoyer des
                cadeaux ou recevoir votre commande au bureau.
            </p>
            <p>
                <b>Vos adresses sont listées ci-dessous. </b>
            </p>
            <p>
                Pensez à les tenir à jour si ces dernières venaient à changer.</br>
            </p>
        </div>

        <sections id="adresses">
            @foreach ($adresses as $adresse)
                <article class="adresse">
                    <h2 class="titre"><a href="/adresse/{{ $adresse->idadresse }}">{{ $adresse->nomadresse }}</a></h2>
                    <div class="contenu">
                        <hr/>
                        <p>
                            {{ $adresse->nomdestinataireadresse }}
                            {{ $adresse->prenomdestinataireadresse }}
                        </p>
                        <p>
                            {{ $adresse->rueadresse }}
                        </p>
                        <p>
                            {{ $adresse->cpadresse }}
                            {{ $adresse->villeadresse }}
                        </p>
                        <p>
                            {{ $adresse->paysadresse }}
                        </p>
                        <a class="modifier button" href="/adresse/{{ $adresse->idadresse }}/modifier">Modifier</a>
                        <a class="supprimer button" href="/adresse/{{ $adresse->idadresse }}/supprimer">Supprimer</a>
                    </div>
                </article>
            @endforeach
            <a class="ajouter button" href="/adresse/ajouter">Ajouter une adresse</a>
        </sections>
    </main>
    @include('layout.footer')
@endsection
