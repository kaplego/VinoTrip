@extends('layout.app')

@section('body')
    @include('layout.header')

    <main>

        <p>{{$client->idclient}}</p>
        <p>{{$client->nomclient}}</p>
        <p>{{$client->prenomclient}}</p>
        <p>{{$client->emailclient}}</p>

    </main>
@endsection
