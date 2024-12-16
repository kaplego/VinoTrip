@php
    $active = 'compte';
@endphp

@extends('layout.app')

@section('title', 'Commande complétée - VinoTrip')

@section('head')
    <link rel="stylesheet" href="/assets/css/client/compte.css">
@endsection

@section('body')
    @include('layout.header')
    <main class="container-sm">
        @include('layout.breadcrumb')
        <h1>Récapitulatif de commande</h1>
        <hr class="separateur-titre" />
        <div id="account">
            <div class="alert alert-success">
                <i data-lucide="circle-check-big"></i>
                Votre commande a bien été validée.
            </div>
        </div>
    </main>
    @include('layout.footer')
@endsection
