@php
    $active = 'sejours-list';
@endphp

@extends('layout.app')

@section('title', 'Séjours en création - VinoTrip')

@section('head')
    <link rel="stylesheet" href="/assets/css/sejours/sejours.css">
@endsection

@section('body')
    @include('layout.header')

    <main class="container">
        @php
            $breadcrumReplaceName = ['/sejours/validate' => 'Non publiés'];
        @endphp
        @include('layout.breadcrumb')

        <h1>Séjours en création</h1>
        <hr class="separateur-titre" />

        <section id="sejours">
            @php
                $i = 0;
                $cpt = 0;
                $note = 0;
            @endphp
            @foreach ($sejours as $sejour)
                @php
                    $note = 0;
                    $localites = [];
                    if ($sejour->localite) {
                        $localites[] = $sejour->localite->idlocalite;
                    }
                @endphp

                <article class="sejour" data-categorie="{{ $sejour->idcategoriesejour }}"
                    data-theme="{{ $sejour->idtheme }}" data-vignoble="{{ $sejour->idcategorievignoble }}"
                    data-duree="{{ $sejour->idduree }}" data-localite="{{ implode(',', $localites) }}"
                    data-participant="{{ $sejour->categorieparticipant->idcategorieparticipant }}">
                    <h2 class="titre"><a href="/sejour/{{ $sejour->idsejour }}">{{ $sejour->titresejour }}</a></h2>
                    <img class="image" data-src="/storage/sejour/{{ $sejour->photosejour }}" />
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
                                <a href="/sejour/{{ $sejour->idsejour }}#avis">Voir les avis</a>
                            </div>
                        @endif
                        <a class="decouvrir button" href="/sejour/{{ $sejour->idsejour }}">Découvrir</a>
                    </div>
                </article>
                @php
                    $i++;
                @endphp
            @endforeach
        </section>
    </main>
    @include('layout.footer')

@endsection

@section('scripts')
    <script src="/assets/js/sejours.js"></script>
@endsection
