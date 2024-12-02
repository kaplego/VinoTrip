

@extends('layout.app')

@section('title', 'Séjours - VinoTrip')

@section('head')
    <link rel="stylesheet" href="/assets/css/summary.css">
@endsection

@section('body')
    @include('layout.header')
    @php
        $jour = 1
    @endphp
    <main class="container-lg">
        <section class="sejour">
            <img class="image" src="/assets/images/sejour/{{ $sejour->photosejour }}" />
            <h2 class="titre2"> {{$sejour->titresejour}}
        </section>

        <hr>

        <h2 class="titre2">Le programme détaillé de votre séjour</h2>

        <section class="Etape">
            @foreach ($sejour->etape as $etape)

                <h2 >Jour {{$jour}} {{$etape->titreetape}}</h2>
                <p>{{$etape->descriptionetape}}</p>
                @php
                    $jour ++
                @endphp
            @endforeach
        </section>

        <hr>
        <h2>Les hébergements proposés</h2>

        <section class="hebergement">
            @foreach ($sejour->etape as $etape)
                    @foreach($etape->hebergement as $unhebergement)
                        <img class="imgheberg" src="/assets/images/hebergement/{{$unhebergement->photohebergement}}"></h2>
                        <p>{{$unhebergement->descriptionhebergement}}</p>
                    @endforeach
            @endforeach
        </section>

        <h2 id="avis">Les Avis ...</h2>
        <section class="avis">
            @foreach ($sejour->avis as $avis)
                <p>{{$avis->descriptionavis}}</p>
            @endforeach
        </section>

    </main>
    @include('layout.footer')

@endsection

@section('scripts')
    <script src="/assets/js/sejours.js"></script>
@endsection
