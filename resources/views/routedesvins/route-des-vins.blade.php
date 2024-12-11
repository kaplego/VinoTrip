@php
    $active = 'route_des_vins';
@endphp

@extends('layout.app')

@section('title', 'Route des vins - VinoTrip')

@section('head')
    <link rel="stylesheet" href="/assets/css/routedesvins/style.css">
@endsection


@section('body')
    @include('layout.header')
    <main class="container-lg">
        @include('layout.breadcrumb')
        <sections id="routes">
            @foreach ($routes as $route)
                <article class="route">
                    <h2 class="titre"><a href="/route/{{ $route->idroute }}">{{ $route->titreroute }}</a></h2>
                    <img class="image" src="/assets/images/routedesvins/{{ $route->photoroute }}" />
                    <div class="contenu">
                        <p class="vignoble">
                            {{ $route->categorievignoble[0]->libellecategorievignoble }}
                        </p>
                        <hr/>
                        <p class="description">{{$route->descriptionroute }}</p>
                        <a class="decouvrir button" href="/route_des_vins/{{ $route->idroute }}">Découvrir</a>
                    </div>
                </article>
            @endforeach
        </sections>
    </main>
    @include('layout.footer')

@endsection
