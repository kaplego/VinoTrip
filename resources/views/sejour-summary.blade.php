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
            <div id="description">
                <h1 class="titre"> {{ $sejour->titresejour }}</h1>
                <hr>
                <h4 class="prix">Prix: {{ $sejour->prixsejour }}€/personne</h3>
                    <p class="descriptionsej">{{ $sejour->descriptionsejour }}</p>
                    <div id="categorie">
                        <p class="descriptionsej">{{ $sejour->categoriesejour->libellecategoriesejour }}</p>
                        <p class="descriptionsej">{{ $sejour->categorievignoble->libellecategorievignoble }}</p>
                        <p class="descriptionsej">{{ $sejour->duree->libelleduree }}</p>
                        <p class="descriptionsej">{{ $sejour->theme->libelletheme }}</p>
                    </div>
                    <div>
                        <a class="button" href="/personnaliser/{{ $sejour->idsejour }}">Personnaliser ou offrir</a>
                    </div>
            </div>
        </section>

        <hr>

        <h2 class="titreg">Le programme détaillé de votre séjour</h2>

        <section id="Etape">
            @foreach ($sejour->etape as $etape)
                <h2>Jour {{ $jour }} {{ $etape->titreetape }}</h2>
                <p>{{ $etape->descriptionetape }}</p>
                <img class="image" src="/assets/images/etape/{{ $etape->photoetape }}" />
                @php
                    $jour++;
                @endphp
            @endforeach
        </section>

        <hr>
        <h2 class="titreg">Les hébergements proposés</h2>

        <section id="hebergements">
            @foreach ($sejour->etape as $etape)
                <article class="hebergement">
                    <img class="imgheberg"
                        src="/assets/images/hebergement/{{ $etape->hebergement->photohebergement }}"></img>
                    <p class="descrheberg">{{ $etape->hebergement->descriptionhebergement }}</p>
                    <a class="lienheberg" href="{{ $etape->hebergement->lienhebergement }}"
                        target="_blank">{{ $etape->hebergement->hotel->nompartenaire }}</a>
                </article>
            @endforeach
        </section>

        <hr>
        <h2 class="titreg">Les châteaux et les domaines...</h2>

        <section id="chateaux">
            @foreach ($sejour->etape as $etape)
                <article class="unchateaux">
                    @foreach ($etape->visite as $unevisite)
                        <img class="imgchateaux" src="/assets/images/visite/{{ $unevisite->photovisite }}"></img>
                        <p class="descrchateaux">{{ $unevisite->descriptionvisite }}</p>
                        @foreach ($unevisite->cave as $unecave)
                            <a class="lienchateaux" href="{{ $unevisite->lienvisite }}"
                                target="_blank">{{ $unecave->nompartenaire }}</a>
                        @endforeach
                    @endforeach
                </article>
            @endforeach
        </section>


        @foreach ($sejour->avis as $avis)
            @php
                $cpt++;
            @endphp
        @endforeach
        @if ($cpt != 0)
            <hr>
            <h2 class="titreg">Les Avis ...</h2>
            <section id="avis">
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
                            $sub = substr($text, 0, 1);
                        @endphp
                        {{ $avis->client->nomclient }} {{ $sub }}. &nbsp;|&nbsp; {{ $avis->titreavis }}
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
