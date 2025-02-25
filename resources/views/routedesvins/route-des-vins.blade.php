@php
    $active = 'routes-des-vins';
@endphp

@extends('layout.app')

@section('title', 'Route des vins - VinoTrip')

@section('head')
    <link rel="stylesheet" href="/assets/css/routedesvins/style.css">
@endsection


@section('body')
    @include('layout.header')
    <main class="container">
        @include('layout.breadcrumb')
        <h1>Routes des Vins</h1>
        <nav id="titre">
            <hr />
        </nav>
        <h3>PARTIR SUR LA ROUTE DES VINS</h3>
        <p>La route des vins est une route touristique qui vous plonge au cœur des régions viticoles, à la rencontre du vin bien sûr, des viticulteurs,
            du vignoble, mais également de la gastronomie, du patrimoine culturel et des autres atouts touristiques régionaux. Le développement de l’œnotourisme,
            en France et à l’international, a conduit à la création du concept de route des vins, qu’il ait été créé par des organismes institutionnels
            du tourisme visant à mettre en avant une région viticole ou qu’il s’agisse simplement d’un circuit touristique recommandé par un guide.
            Cela reste une expérience de visite unique d’un vignoble permettant de concilier découverte du vin et exploration d’une région !
        </p>
        <div id="images">
            <img src="/assets/images/routedesvins/Route_des_vins.jpg" alt="Route des vins" width="300" height="200">
            <img src="/assets/images/routedesvins/Tourisme_route_des_vins.jpg" alt="Tourisme route des vins" width="302" height="200">
            <img src="/assets/images/routedesvins/Visite_route_des_vins.jpg" alt="Visite route des vins" width="265" height="200">
        </div>
        <h3>LES ROUTES DES VINS EN FRANCE</h3>
        <p>
            Les routes des vins sillonnent tous les vignobles français. Créées à partir des années 1950, ces itinéraires vous offrent l’opportunité unique de plonger,
            tête la première, au cœur d’une région viticole : découvertes œnologiques, culturelles et gastronomiques sont au programme. </br>
            Aujourd’hui près de 7,5 millions d’oenotouristes* parcourent les vignobles chaque année :
            Français et étrangers, débutants et experts, tous les publics se retrouvent pour une balade de caves en caves,
            de dégustations de vins. De la plus connue comme <a href="{{ route('route-vins', ['id' => 1]) }}"> la route des vins d'Alsace</a> à la plus confidentielle, la plus longue à la plus brève,
            la plus ensoleillée à la plus fraîche, nous vous proposons un petit tour d’horizon des routes des vins de France, à visiter ou à (re)visiter.
            Les itinéraires des routes des vins de France seront vous charmer, que cela soit en voiture, à pied ou à vélo ! </br>
            <i>* Source : <a href="{{ url('https://www.atout-france.fr/') }}">Atout France</a>, Tourisme et Vin - données 2010</i>
        </p>
        <sections id="routes">
            @foreach ($routes as $route)
                <article class="route">
                    <h2 class="titre"><a href="{{ route('route-vins', ['id' => $route->idroute]) }}">{{ $route->titreroute }}</a></h2>
                    <img class="image" src="/assets/images/routedesvins/{{ $route->photoroute }}" />
                    <div class="contenu">
                        <p class="vignoble">
                            {{ $route->categorievignoble[0]->libellecategorievignoble }}
                        </p>
                        <hr/>
                        <p class="description">{{$route->descriptionroute }}</p>
                        <a class="decouvrir button" href="{{ route('route-vins', ['id' => $route->idroute]) }}">Découvrir</a>
                    </div>
                </article>
            @endforeach
        </sections>
    </main>
    @include('layout.footer')

@endsection
