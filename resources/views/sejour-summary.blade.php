@php
    $active = 'sejours-list';
@endphp

@extends('layout.app')

@section('title', 'Séjours - VinoTrip')

@section('head')
    <link rel="stylesheet" href="/assets/css/sejours.css">
@endsection

@section('body')
    @include('layout.header')

    <section class="sejour">

        <img id="image" src="/assets/images/sejour/{{ $sejour->photosejour }}" />
        <p id="titresej"> {{$sejour->descriptionsejour}}
    </section>

    @include('layout.footer')

@endsection

@section('scripts')
    <script src="/assets/js/sejours.js"></script>
@endsection
