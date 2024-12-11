@extends('layout.app')

@section('title', $route->titreroute . ' - VinoTrip')

@section('head')
    <link rel="stylesheet" href="/assets/css/routedesvins/summary.css">
@endsection

@section('body')
    @include('layout.header')

    <main class="container">
        @include('layout.breadcrumb')

        <section id="route">
            <img class="image" src="/assets/images/routedesvins/{{ $route->photoroute }}" />
            <div id="description">
                <h1 class="titre">{{ $route->titreroute }}</h1>
                <hr>
                <div id="categorie">
                    <p class="descriptionroute">{{ $route->categorievignoble[0]->libellecategorievignoble }}</p>
                </div>
                    <p class="descriptionroute">{{ $route->descriptionroute }}</p>
            </div>
        </section>

        <hr>

        <h2 class="titreg">Les différents vignobles</h2>



    </main>
    @include('layout.footer')

@endsection
