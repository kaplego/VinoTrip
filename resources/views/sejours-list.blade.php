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
            <select id="vignoble">
                <option value="null" selected disabled disabled>Quel vignoble ?</option>
                <option value="all">Tous les vignoble</option>

                @foreach ($categoriesvignoble as $categorie)
                    <option value={{$categorie->idcategorievignoble}}>{{$categorie->libellecategorievignoble}}</option>
                @endforeach
            </select>

            <select id="localite" class="hidden">
                <option value="null" selected disabled>Localité ?</option>
                <option value="all">Toutes les localités</option>

                @foreach ($destination as $categorie)
                    <option value={{$categorie->iddestination}}>{{$categorie->libelledestination}}</option>
                @endforeach
            </select>

            <select id="duree">
                <option value="null" selected disabled>Durée ?</option>
                <option value="all">Toutes les durées</option>

            </select>

            <select id="participant">
                <option value="null" selected disabled>Pour qui ?</option>
                <option value="all">Tout le monde</option>

                @foreach ($categorieparticipant as $categorie)
                    <option value={{$categorie->idcategorieparticipant}}>{{$categorie->libellecategorieparticipant}}</option>
                @endforeach
            </select>

            <select id="envies">
                <option value="null" selected disabled>Une envie particulière ?</option>
                <option value="all">Toutes les envies</option>

                @foreach ($categoriesejour as $categorie)
                    <option value={{$categorie->idcategoriesejour}}>{{$categorie->libellecategoriesejour}}</option>
                @endforeach
            </select>

            <button type="submit">🔎</button>

        </form>
        <nav id="sejours">
            @foreach ($sejours as $sejour)
                <section>
                <h2 id="hsej">{{$sejour->titresejour}}</h2>
                <br>
                <img id="imgsej"  src="/assets/images/{{$sejour->photosejour}}"></img>
                <br>
                <p id="txtsej" >{{$sejour->descriptionsejour}}</p>

                </section>
            @endforeach
        </nav>
    </main>
@endsection
