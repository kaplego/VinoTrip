@extends('layout.app')
@section('head')
    <link rel="stylesheet" href="/assets/css/welcome.css">
@endsection
@section('body')
    @include('layout.header')
    <main class="container-sm">
        {{-- <h3>Avis des voyageurs</h3>
        <hr/>
        <section id="Etape">
            @foreach ($sejours->etape as $etape)
                <h2>Jour {{ $jour }} {{ $etape->titreetape }}</h2>
                <p>{{ $etape->descriptionetape }}</p>
                <img class="image" src="url:'{{ $etape->photoetape }}'" />
                @php
                    $jour++;
                @endphp
            @endforeach
        </section> --}}
    </main>
    @include('layout.footer')
@endsection
