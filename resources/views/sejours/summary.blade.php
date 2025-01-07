@php
    $active = 'sejours-list';
@endphp

@extends('layout.app')

@section('title', $sejour->titresejour . ' - VinoTrip')

@section('head')
    <link rel="stylesheet" href="/assets/css/sejours/summary.css">
    <meta name="description" content="{{ $sejour->descriptionsejour }}">
    <meta property="twitter:card" content="https://vinotrip.lmgt.me/storage/sejour/{{ $sejour->photosejour }}">
    <meta property="og:image" content="https://vinotrip.lmgt.me/storage/sejour/{{ $sejour->photosejour }}">
@endsection

@section('body')
    @include('layout.header')
    @php
        $jour = 1;
        $cpt = 0;
    @endphp
    <main class="container">
        @php
            $breadcrumReplaceLink = ['/sejour' => '/sejours'];
            $breadcrumReplaceName = ['/sejour' => 'Sejours', "/sejour/$sejour->idsejour" => $sejour->titresejour];
        @endphp
        @include('layout.breadcrumb')

        @if (!$sejour->publie)
            <form class="alert alert-warning" action="/api/sejour/{{ $sejour->idsejour }}/publish" method="POST">
                @csrf
                <i data-lucide="lock"></i>
                <span class="text">Le séjour n'est pas encore publié.</span>
                <button class="button" type="submit">Publier le séjour</button>
            </form>
        @endif

        <section id="sejour">
            <img class="image" src="/storage/sejour/{{ $sejour->photosejour }}" />
            <div id="description">
                <h1 class="titre">{{ $sejour->titresejour }}</h1>
                <hr>
                @if (isset($sejour->nouveauprixsejour))
                    <h4 class="prix" style="text-decoration-line: line-through;">Prix: {{ $sejour->prixsejour }}€ /
                        personne</h4>
                    <h4 class="prix" style="color: red; text-decoration-line:underline;">Prix:
                        {{ $sejour->nouveauprixsejour }}€ / personne</br>
                        Profitez de
                        {{ round((1 - ($sejour->nouveauprixsejour ?? $sejour->prixsejour) / $sejour->prixsejour) * 100, 1) }}%
                        de réduction !
                    </h4>
                @else
                    <h4 class="prix">Prix: {{ $sejour->prixsejour }}€ / personne</h4>
                @endif
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
                <div>
                    @if (Helpers::AuthIsRole(Role::ServiceVente))
                        <div>
                            <a class="button" href="/sejour/{{ $sejour->idsejour }}/edit">Modifier séjour</a>
                        </div>
                    @endif

                    @if (Helpers::AuthIsRole(Role::ServiceMarketing))
                        <div>
                            <button class="reduction button" data-idsejour="{{ $sejour->idsejour }}">Appliquer une
                                réduction</button>
                        </div>
                    @endif

                    @if (Auth::check())
                        @if (Auth::user()->favoris->contains($sejour))
                            <form id="favoris" class="favoris" method="post" action="/api/client/favoris/delete">
                                @csrf
                                <input type="hidden" name="idsejour" value="{{ $sejour->idsejour }}">
                                <button class="icon-button" type="submit" data-tooltip="Retirer des favoris"><i
                                        data-lucide="heart"></i></button>
                            </form>
                        @else
                            <form id="favoris" method="post" action="/api/client/favoris/add">
                                @csrf
                                <input type="hidden" name="idsejour" value="{{ $sejour->idsejour }}">
                                <button class="icon-button" type="submit" data-tooltip="Ajouter aux favoris"><i
                                        data-lucide="heart"></i></button>
                            </form>
                        @endif
                    @endif
                </div>
            </div>
        </section>

        <hr>

        <h2 class="titreg">Le programme détaillé de votre séjour</h2>

        <section id="etapes">
            @foreach ($sejour->etape as $etape)
                <article class="etape">
                    <h2>Étape {{ $jour }} : {{ $etape->titreetape }}</h2>
                    <p>{{ $etape->descriptionetape }}</p>
                    <img class="image" src="/storage/etape/{{ $etape->photoetape }}" />
                </article>
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
                    {{-- {{ $etape->hebergement->lienhebergement }} --}}
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
                            <a class="lienchateaux" href="https://www.vinotrip.com/fr/partenaires/25-domaine-trapet"
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
                    <a class="button signaler" href="/sejour/{{$sejour->idsejour}}#avis">Signaler l'avis</a>
                @endforeach
            </section>
        @endif
        <form class="overlay hidden" id="reduc" method="post" action="/api/sejour/discount">
            @csrf
            <div class="overlay-content">
                <h2>Indiquer le nouveau prix voulu :</h2>
                <input type="hidden" name="idsejour" id="reduc-idsejour">

                <div class="input">
                    <div class="input-control input-control-text required">
                        <label for="reduc-nouvprix">Nouveau prix (€)</label>
                        <input type="number" basevalue="{{ $sejour->nouveauprixsejour ?? $sejour->prixsejour }}"
                            step="0.01" value="{{ $sejour->nouveauprixsejour ?? $sejour->prixsejour }}"
                            min="0" max="{{ $sejour->prixsejour }}" name="nouveauprixsejour"
                            id="reduc-nouvprix">
                    </div>
                    <div class="input-control input-control-text required">
                        <label for="reduc-pourcentage">Réduction (%)</label>
                        <input
                            type="number"
                            basevalue="{{ round((1 - ($sejour->nouveauprixsejour ?? $sejour->prixsejour) / $sejour->prixsejour) * 100, 2) }}"
                            step="0.01"
                            value="{{ round((1 - ($sejour->nouveauprixsejour ?? $sejour->prixsejour) / $sejour->prixsejour) * 100, 2) }}"
                            min="0" max="100" name="pourcentagereduction" id="reduc-pourcentage">
                </div>

                <div id="reduction-buttons">
                    <button type="button" class="button" id="reduc-annuler">Annuler</button>
                    <button type="submit" class="button">Appliquer</button>
                </div>
            </div>
        </form>
    </main>
    @include('layout.footer')

@endsection

@section('scripts')
    <script src="/assets/js/avis.js" defer></script>
    <script src="/assets/js/reduction.js" defer></script>
@endsection
