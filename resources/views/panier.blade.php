@php
    $active = 'panier';
@endphp

@extends('layout.app')

@section('head')
    <link rel="stylesheet" href="/assets/css/panier.css">
@endsection

@section('body')
    @include('layout.header')
    <main class="container-sm">
        <h1>Votre Panier</h1>
        <hr class="separateur-titre" />

        @if ($panier === null || sizeof($panier->descriptionspanier) === 0)
            <p id="empty-cart"><i data-lucide="shopping-cart"></i> Votre panier est vide !</p>
        @else
            <section id="liste-sejours">
                @foreach ($panier->descriptionspanier ?? [] as $descriptionpanier)
                    @php
                        $sejour = $descriptionpanier->sejour;
                    @endphp
                    <article class="descriptionpanier">
                        <form action="/api/panier/update" method="post">
                            @csrf
                            <input type="hidden" name="idsejour" value="{{ $sejour->idsejour }}">
                            <div class="sejour">
                                <h2>{{ $sejour->titresejour }}</h2>
                                <img class="photo" src="/assets/images/sejour/{{ $sejour->photosejour }}"
                                    alt="{{ $sejour->titresejour }}">
                            </div>
                            <div class="infos">
                                <input class="input-text" type="number" name="quantite" autocomplete="off" min="1"
                                    id="quantite-{{ $sejour->idsejour }}" value="{{ $descriptionpanier->quantite }}">
                                <div class="buttons">
                                    <button class="button" type="submit" name="action" value="update">
                                        <i data-lucide="save"></i>
                                    </button>
                                    <button class="button" type="submit" name="action" value="delete">
                                        <i data-lucide="trash-2"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </article>
                @endforeach
            </section>
        @endif

        <aside class="mt-5">
            <h2>Étapes de réservation</h2>
            <ol>
                <li>Vous confirmez votre demande de réservation. Nous revenons vers vous sous 24h après validation des
                    disponibilités auprès de nos partenaires.</li>
                <li>Vous payez en ligne.</li>
                <li>Vous recevez votre carnet de route contenant toutes les informations pratiques (heures de rendez-vous,
                    adresses...).</li>
            </ol>
            <p><strong>Bon voyage !</strong></p>
        </aside>
    </main>
    @include('layout.footer')
