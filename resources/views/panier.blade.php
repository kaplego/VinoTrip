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
                        $nbPersonnes = $descriptionpanier->nbadultes + $descriptionpanier->nbenfants;
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
                            <table class="details">
                                <tbody>
                                    <tr>
                                        <td>Dates</td>
                                        <td colspan="2">Départ
                                            {{ date_format(new DateTime($descriptionpanier->datedebut), 'd/m/Y') }}<br />
                                            Retour {{ date_format(new DateTime($descriptionpanier->datefin), 'd/m/Y') }}</td>
                                    </tr>
                                    <tr>
                                        <td>Adultes</td>
                                        <td>{{ $descriptionpanier->nbadultes }}</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Enfants</td>
                                        <td>{{ $descriptionpanier->nbenfants }}</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Chambres</td>
                                        <td>{{ $descriptionpanier->nbchambressimple }} simple<br />
                                            {{ $descriptionpanier->nbchambresdouble }} double<br />
                                            {{ $descriptionpanier->nbchambrestriple }} triple</td>
                                        <td class="prix">{{ $descriptionpanier->nbchambressimple * 75 }} €
                                            <br />{{ $descriptionpanier->nbchambresdouble * 100 }} €
                                            <br />{{ $descriptionpanier->nbchambrestriple * 125 }} €
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Repas</td>
                                        <td>
                                            @if (!$descriptionpanier->repasmidi && !$descriptionpanier->repassoir)
                                                aucun
                                            @else
                                                @php
                                                    $repas = [];
                                                    if ($descriptionpanier->repasmidi) {
                                                        $repas[] = 'midi';
                                                    }
                                                    if ($descriptionpanier->repassoir) {
                                                        $repas[] = 'soir';
                                                    }
                                                @endphp
                                                {{ implode(',', $repas) }}
                                            @endif
                                        </td>
                                        <td class="prix">
                                            {{ $nbPersonnes }} ×
                                            {{ ($descriptionpanier->repasmidi ? 20 : 0) + ($descriptionpanier->repassoir ? 20 : 0) }}
                                            €
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Activités</td>
                                        <td>
                                            {{ $descriptionpanier->activite ? 'oui' : 'non' }}
                                        </td>
                                        <td class="prix">
                                            {{ $nbPersonnes }} ×
                                            {{ $descriptionpanier->activite ? 50 : 0 }} €
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Cadeau</td>
                                        <td>
                                            @if ($descriptionpanier->offrir)
                                                oui,
                                                {{ $descriptionpanier->ecoffret ? 'e-coffret' : 'coffret postal' }}
                                            @else
                                                non
                                            @endif
                                        </td>
                                        <td class="prix">
                                            {{ $descriptionpanier->ecoffret ? 0 : 5 }} €
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="prix-total">
                                <span class="text">Prix total</span>
                                <span class="prix">{{ number_format($descriptionpanier->prix, 2, ',', ' ') }} €</span>
                            </div>
                            <div class="infos">
                                <a class="button" href="/modifier/{{ $descriptionpanier->idsejour }}">
                                    <i data-lucide="pencil"></i> Modifier les détails
                                </a>
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
