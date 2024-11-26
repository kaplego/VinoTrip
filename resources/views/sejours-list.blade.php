@php
    $active = 'sejours-list';
@endphp

@extends('layout.app')

@section('head')
    <link rel="stylesheet" href="/assets/css/sejours.css">
@endsection

@section('body')
    @include('layout.header')

    <main>
        <form id="filtres" method="get">
            <select id="vignoble" autocomplete="off">
                <option value="null" selected disabled disabled>Quel vignoble ?</option>
                <option value="all">Tous les vignoble</option>

                @foreach ($categoriesvignoble as $categorie)
                    <option value={{$categorie->idcategorievignoble}}>{{$categorie->libellecategorievignoble}}</option>
                @endforeach
            </select>

            <select id="localite" autocomplete="off">
                <option value="null" selected disabled>Localité ?</option>
                <option value="all">Toutes les localités</option>

                @foreach ($destination as $categorie)
                    <option value={{$categorie->iddestination}}>{{$categorie->libelledestination}}</option>
                @endforeach
            </select>

            <select id="duree" autocomplete="off">
                <option value="null" selected disabled>Durée ?</option>
                <option value="all">Toutes les durées</option>

            </select>

            <select id="participant" autocomplete="off">
                <option value="null" selected disabled>Pour qui ?</option>
                <option value="all">Tout le monde</option>

                @foreach ($categorieparticipant as $categorie)
                    <option value={{$categorie->idcategorieparticipant}}>{{$categorie->libellecategorieparticipant}}</option>
                @endforeach
            </select>

            <select id="envies" autocomplete="off">
                <option value="null" selected disabled>Une envie particulière ?</option>
                <option value="all">Toutes les envies</option>

                @foreach ($categoriesejour as $categorie)
                    <option value={{$categorie->idcategoriesejour}}>{{$categorie->libellecategoriesejour}}</option>
                @endforeach
            </select>

            <button type="submit">
                <i data-lucide="search"></i>
            </button>

        </form>
        <section id="sejours">
            @for ($i = 0; $i < 10; $i++)
                @php
                    $sejour = $sejours[$i];
                @endphp

                <!-- NE PAS METTRE D'ID DANS LES BOUCLES : les id doivent être UNIQUES
                    Utilisez des CLASSES  -->

                <article class="sejour">
                    <h2 class="titre"><a href="/sejour/{{$sejour->idsejour}}">{{$sejour->titresejour}}</a></h2>
                    <img class="image"  src="/assets/images/{{$sejour->photosejour}}" />
                    <div class="contenu">
                        <p class="description">{{$sejour->descriptionsejour}}</p>
                        <p class="categorie-vignoble">
                            <span class="subtitle">Vignoble</span>
                            <span>{{$sejour->categorievignoble->libellecategorievignoble}}</span>
                        </p>
                        <p class="destination">
                            <span class="subtitle">Destination</span>
                            <span>{{$sejour->destination->libelledestination}}</span>
                        </p>
                        <p class="categorie-sejour">
                            <span class="subtitle">Catégorie du Séjour</span>
                            <span>{{$sejour->categoriesejour->libellecategoriesejour}}</span>
                        </p>
                        <p class="theme">
                            <span class="subtitle">Thème</span>
                            <span>{{$sejour->theme->libelletheme}}</span>
                        </p>
                    </div>
                </article>
            @endfor
        </section>
    </main>
@endsection

@section('scripts')
    <script src="/assets/js/sejours.js"></script>
@endsection
