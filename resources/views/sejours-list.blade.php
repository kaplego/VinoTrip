@php
    $active = 'sejours-list';
@endphp

@extends('layout.app')

@section('title', 'Séjours - VinoTrip')

@section('head')
    <link rel="stylesheet" href="/assets/css/sejours.css">
@endsection

@section('body')
    @include('layout.header')

    <main class="container-lg">
        <form id="filtres" method="get">
            <select id="vignoble" name="vignoble" autocomplete="off">
                <option selected disabled>Quel vignoble ?</option>
                <option value="all">Tous les vignoble</option>

                @foreach ($categoriesvignoble as $categorie)
                    <option value="{{ $categorie->idcategorievignoble }}">{{ $categorie->libellecategorievignoble }}</option>
                @endforeach
            </select>

            <select id="localite" name="localite" autocomplete="off" class="hidden">
                <option selected disabled>Localité ?</option>
                <option value="all">Toutes les localités</option>

                @foreach ($localites as $localite)
                    <option value={{ $localite->idlocalite }} data-vignoble="{{ $localite->idcategorievignoble }}">{{ $localite->libellelocalite }}</option>
                @endforeach
            </select>

            <select name="duree" autocomplete="off">
                <option selected disabled>Durée ?</option>
                <option value="all">Toutes les durées</option>
                @foreach ($durees as $duree)
                    <option value={{ $duree->idduree }}>{{ $duree->libelleduree }}</option>
                @endforeach
            </select>

            <select name="participant" autocomplete="off">
                <option selected disabled>Pour qui ?</option>
                <option value="all">Tout le monde</option>

                @foreach ($categorieparticipant as $participant)
                    <option value={{ $participant->idcategorieparticipant }}>{{ $participant->libellecategorieparticipant }}
                    </option>
                @endforeach
            </select>

            <select name="envies" autocomplete="off">
                <option selected disabled>Une envie particulière ?</option>
                <option value="all">Toutes les envies</option>

                @foreach ($categoriesejour as $categorie)
                    <option value={{ $categorie->idcategoriesejour }}>{{ $categorie->libellecategoriesejour }}</option>
                @endforeach
            </select>

            <button type="submit">
                <i data-lucide="filter"></i>
                <span class="mobile">Filtrer</span>
            </button>

        </form>

        <section id="sejours">
            @php
                $i = 0;
                $cpt = 0;
                $note = 0;
            @endphp
            @foreach ($sejours as $sejour)
                @php
                $note=0;
                    $participants = [];
                    foreach ($sejour->categorieparticipant as $participant) {
                        $participants[] = $participant->idcategorieparticipant;
                    }

                    $localites = [];
                    foreach ($sejour->localite as $localite) {
                        $localites[] = $localite->idlocalite;
                    }
                @endphp

                <article class="sejour"
                    data-categorie="{{ $sejour->idcategoriesejour }}" data-theme="{{ $sejour->idtheme }}"
                    data-vignoble="{{ $sejour->idcategorievignoble }}" data-duree="{{$sejour->idduree}}"
                    data-localite="{{ implode(',', $localites) }}"
                    data-participants="{{ implode(',', $participants) }}">
                    <h2 class="titre"><a href="/sejour/{{ $sejour->idsejour }}">{{ $sejour->titresejour }}</a></h2>
                    <img class="image" data-src="/assets/images/sejour/{{ $sejour->photosejour }}" />
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
                            @foreach ($sejour->categorieparticipant as $participant)
                                <div data-tooltip="{{ $participant->libellecategorieparticipant }}">
                                    @switch($participant->idcategorieparticipant)
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
                            @endforeach
                        </div>
                        <p class="vignoble">
                            {{ $sejour->categorievignoble->libellecategorievignoble }}
                        </p>
                        <hr />
                        <p class="prix">À partir de <span class="euros">{{ $sejour->prixsejour }}€</span> par personne</p>
                        <p class="description">{{ $sejour->descriptionsejour }}</p>
                        <p class="duree">{{ $sejour->duree->libelleduree }}</p>
                        @php
                            $cpt=0
                        @endphp
                        @foreach ($sejour->avis as $avis)
                            @php
                                $cpt ++;
                            @endphp
                        @endforeach
                        @if ($cpt!=0)
                            @foreach ($sejour->avis as $avis)
                                @php
                                    $note += $avis->noteavis;
                                @endphp
                            @endforeach
                            @php
                                $note=$note/$cpt;
                                $note=round($note,1);
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
