@extends('layout.app')
@section('head')
    <link rel="stylesheet" href="/assets/css/welcome.css">
@endsection
@section('title', 'Séjours - VinoTrip')

@section('body')
    @include('layout.header')
    <main class="container-sm">
        <h3>Avis des voyageurs</h3>
        <hr id="ligne">
    </main>
    @include('layout.footer')
@endsection
