@php
    $active = 'route-des-vins';
@endphp

@extends('layout.app')

@section('title', $route->titreroute . ' - VinoTrip')

@section('head')
    <link rel="stylesheet" href="/assets/css/routedesvins/summary.css">
    <link rel="stylesheet" href="/assets/css/sejours/sejours.css">
@endsection

@section('body')
    @include('layout.header')

    <main class="container">
        @include('layout.breadcrumb')

        <section id="route">
            <img class="image" src="/assets/images/routedesvins/{{ $route->photoroute }}" />
            <div id="description">
                <h1 class="titre">{{ $route->titreroute }}</h1>
                <hr>
                <div id="categorie">
                    <p class="descriptionroute">{{ $route->categorievignoble[0]->libellecategorievignoble }}</p>
                </div>
                <p class="descriptionroute">{{ $route->descriptionroute }}</p>
            </div>
        </section>

        <hr>

        <h2 class="titreg">Les différents vignobles</h2>
        <section id="sejours">
            @foreach ($route->categorievignoble[0]->Sejour as $sejour)
                @php
                    $note = 0;

                    $localites = [];
                    if(isset($sejour->localite)){
                        $localites[] = $sejour->localite;
                    }
                @endphp

                <article class="sejour">
                    <h2 class="titre"><a href="{{ route('sejour', ['idsejour' => $sejour->idsejour]) }}">{{ $sejour->titresejour }}</a></h2>
                    <img class="image" src="/storage/sejour/{{ $sejour->photosejour }}" />
                    <div class="contenu">
                        <div class="icones">
                            <div data-tooltip="{{ $sejour->categoriesejour->libellecategoriesejour }}">
                                @switch($sejour->idcategoriesejour)
                                    @case(1)
                                        <i data-lucide="landmark"></i>
                                    @break

                                    @case(2)
                                        <i data-lucide="cooking-pot"></i>
                                    @break

                                    @case(3)
                                        <i data-lucide="volleyball"></i>
                                    @break

                                    @case(4)
                                        <i data-lucide="flower"></i>
                                    @break
                                @endswitch
                            </div>
                            @if (in_array($sejour->theme->libelletheme, [3, 5, 6]))
                                <div data-tooltip="{{ $sejour->theme->libelletheme }}">
                                    @switch($sejour->idtheme)
                                        @case(3)
                                            <i data-lucide="land-plot"></i>
                                        @break

                                        @case(5)
                                            <i data-lucide="leaf"></i>
                                        @break

                                        @case(6)
                                            <i data-lucide="party-popper"></i>
                                        @break
                                    @endswitch
                                </div>
                            @endif
                            <div data-tooltip="{{ $sejour->categorieparticipant->libellecategorieparticipant }}">
                                @switch($sejour->categorieparticipant->idcategorieparticipant)
                                    @case(1)
                                        <i data-lucide="heart"></i>
                                    @break

                                    @case(2)
                                        <i data-lucide="users-round"></i>
                                    @break

                                    @case(3)
                                        <i data-lucide="baby"></i>
                                    @break
                                @endswitch
                            </div>
                        </div>
                        <p class="vignoble">
                            {{ $sejour->categorievignoble->libellecategorievignoble }}
                        </p>
                        <hr />
                        <p class="prix">À partir de <span class="euros">{{ $sejour->prixsejour }}€</span> par personne
                        </p>
                        <p class="description">{{ $sejour->descriptionsejour }}</p>
                        <p class="duree">{{ $sejour->duree->libelleduree }}</p>
                        @php
                            $cpt = 0;
                        @endphp
                        @foreach ($sejour->avis as $avis)
                            @php
                                $cpt++;
                            @endphp
                        @endforeach
                        @if ($cpt != 0)
                            @foreach ($sejour->avis as $avis)
                                @php
                                    $note += $avis->noteavis;
                                @endphp
                            @endforeach
                            @php
                                $note = $note / $cpt;
                                $note = round($note, 1);
                            @endphp
                            <div class="avis">
                                <p class="note">
                                    <i data-lucide="star" fill="currentColor" class="checked"></i>
                                    <i data-lucide="star" fill="currentColor"
                                        class="@if ($note >= 2) checked @endif"></i>
                                    <i data-lucide="star" fill="currentColor"
                                        class="@if ($note >= 3) checked @endif"></i>
                                    <i data-lucide="star" fill="currentColor"
                                        class="@if ($note >= 4) checked @endif"></i>
                                    <i data-lucide="star" fill="currentColor"
                                        class="@if ($note == 5) checked @endif"></i>
                                </p>
                                <p class="valeur">{{ $note }}/5</p>
                                <a href="{{ route('sejour', ['idsejour' => $sejour->idsejour]) }}#avis">Voir les avis</a>
                            </div>
                        @endif
                        <a class="decouvrir button" href="{{ route('sejour', ['idsejour' => $sejour->idsejour]) }}">Découvrir</a>
                    </div>
                </article>
            @endforeach
        </section>


    </main>
    @include('layout.footer')

@endsection
