@extends('layout.app')

@section('title', 'Séjours - VinoTrip')

@section('head')
    <link rel="stylesheet" href="/assets/css/summary.css">
@endsection

@section('body')
    @include('layout.header')
    @php
        $jour = 1;
        $cpt = 0;
    @endphp
    <main class="container-lg">

        <section id="sejour">
            <img class="image" src="/assets/images/sejour/{{ $sejour->photosejour }}" />
            <h2 class="titre2"> {{ $sejour->titresejour }}</h2>
            <h3>{{$sejour->prixsejour}} €</h3>
        </section>

        <form action="/api/panier/add" method="post">
            @csrf
            <input type="hidden" name="idsejour" value="{{ $sejour->idsejour }}">
            <button type="submit">Ajouter au panier</button>
        </form>

        <hr>

        <h2 class="titre2">Le programme détaillé de votre séjour</h2>

        <section id="Etape">
            @foreach ($sejour->etape as $etape)
                <h2>Jour {{ $jour }} {{ $etape->titreetape }}</h2>
                <p>{{ $etape->descriptionetape }}</p>
                <img class="image" src="url:'{{ $etape->photoetape }}'" />
                @php
                    $jour++;
                @endphp
            @endforeach
        </section>

        <hr>
        <h2>Les hébergements proposés</h2>

        <section id="hebergement">
            @foreach ($sejour->etape as $etape)
                @foreach ($etape->hebergement as $unhebergement)
                    <img class="imgheberg" src="/assets/images/hebergement/{{ $unhebergement->photohebergement }}"></img>
                    <p>{{ $unhebergement->descriptionhebergement }}</p>
                    <a href="{{ $unhebergement->lienhebergement }}">lenomdupartenaire</a>
                @endforeach
            @endforeach
        </section>

        <hr>
        <h2>Les châteaux et les domaines...</h2>

        <section id="chateaux">
            @foreach ($sejour->etape as $etape)
                @foreach ($etape->visite as $unevisite)
                    <img class="imgheberg" src="/assets/images/visite/{{ $unevisite->photovisite }}"></img>
                    <p>{{ $unevisite->descriptionvisite }}</p>
                    <a href="{{ $unevisite->lienvisite }}">lenomdupartenaire</a>

                @endforeach
            @endforeach
        </section>


        @foreach ($sejour->avis as $avis)
            @php
                $cpt++;
            @endphp
        @endforeach
        @if ($cpt != 0)
            <h2 id="avis">Les Avis ...</h2>
            <section class="avis">
                @foreach ($sejour->avis as $avis)
                    <p>
                        <i data-lucide="star" fill="currentColor" class="checked"></i>
                        <i data-lucide="star" fill="currentColor"
                            class="@if ($avis->noteavis >= 2) checked @endif"></i>
                        <i data-lucide="star" fill="currentColor"
                            class="@if ($avis->noteavis >= 3) checked @endif"></i>
                        <i data-lucide="star" fill="currentColor"
                            class="@if ($avis->noteavis >= 4) checked @endif"></i>
                        <i data-lucide="star" fill="currentColor"
                            class="@if ($avis->noteavis == 5) checked @endif"></i>
                        {{ $avis->noteavis }}/5 &nbsp;&nbsp;
                        @php
                            $text = $avis->client->prenomclient;
                            $sub = substr($text,0,1);
                        @endphp
                            {{ $avis->client->nomclient }}  {{$sub}}. &nbsp;|&nbsp; {{$avis->titreavis}}
                    </p>
                    <p class="descravis">{{ $avis->descriptionavis }}</p>
                @endforeach
            </section>
        @endif

    </main>
    @include('layout.footer')

@endsection

@section('scripts')
    <script src="/assets/js/sejours.js"></script>
@endsection
