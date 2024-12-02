

@extends('layout.app')

@section('title', 'Séjours - VinoTrip')

@section('head')
    <link rel="stylesheet" href="/assets/css/summary.css">
@endsection

@section('body')
    @include('layout.header')
    @php
        $jour = 1;
        $cpt = 0
    @endphp
    <main class="container-lg">

        <section id="sejour">
            <img class="image" src="/assets/images/sejour/{{ $sejour->photosejour }}" />
            <h2 class="titre2"> {{$sejour->titresejour}}
        </section>

        <hr>

        <h2 class="titre2">Le programme détaillé de votre séjour</h2>

        <section id="Etape">
            @foreach ($sejour->etape as $etape)

                <h2>Jour {{$jour}} {{$etape->titreetape}}</h2>
                <p>{{$etape->descriptionetape}}</p>

                @php
                    $jour ++
                @endphp
            @endforeach
        </section>

        <hr>
        <h2>Les hébergements proposés</h2>

        <section id="hebergement">
            @foreach ($sejour->etape as $etape)
                    @foreach($etape->hebergement as $unhebergement)
                        <img class="imgheberg" src="/assets/images/hebergement/{{$unhebergement->photohebergement}}"></img>
                        <p>{{$unhebergement->descriptionhebergement}}</p>
                    @endforeach
            @endforeach
        </section>
        @foreach ($sejour->avis as $avis)
        @php
            $cpt ++
        @endphp
        @endforeach
        @if ($cpt!=0)
            <h2 id="avis">Les Avis ...</h2>
            <section class="avis">
                @foreach ($sejour->avis as $avis)
                    @switch($avis->noteavis)
                        @case(1)
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                        @break

                        @case(2)
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                        @break

                        @case(3)
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                        @break

                        @case(4)
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star"></span>
                        @break

                        @case(5)
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        @break
                    @endswitch
                    <p>{{$avis->noteavis}}/5</p>
                @endforeach
            </section>
        @endif

    </main>
    @include('layout.footer')

@endsection

@section('scripts')
    <script src="/assets/js/sejours.js"></script>
@endsection
