@extends('layout.app')
@section('head')
    <link rel="stylesheet" href="/assets/css/welcome.css">
@endsection
@section('body')
    @include('layout.header')
    <main class="container-sm">
        <h3>Quelques avis de voyageurs</h3>
        <hr id="ligne">
        <section id="avis">
        @foreach ($listeSejour as $unsejour)
            @php
                $cpt=0
            @endphp
            <h4>{{$unsejour->titresejour}}</h4>
            @foreach($unsejour->avis as $unavis)
                @php
                    $cpt++
                @endphp
                @if ($cpt==1)
                    <article class="unavis">
                        <p>{{ $unavis->titreavis }}</p><br />
                        <p>{{ $unavis->descriptionavis }}<p><br/>
                    </article>
                @endif
            @endforeach
            <hr class="separateur">
        @endforeach
        <div id="divavis">
            <a class="button" href="/avis">Découvrir tout les avis</a>
        </div>
        </section>
    </main>
    @include('layout.footer')
@endsection
