@extends('layout.app')

@section('body')
    @include('layout.header')

    <main>
        @foreach($clients as $client)
            <p>{{$client->idclient}}</p>
            <p>{{$client->nomclient}}</p>
            <p>{{$client->prenomclient}}</p>
            <p>{{$client->emailclient}}</p>
        @endforeach
    </main>
    @include('layout.footer')
@endsection
