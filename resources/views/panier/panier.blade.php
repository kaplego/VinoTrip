@php
    $active = 'panier';
@endphp

@extends('layout.app')

@section('title', 'Panier (' . sizeof($panier?->descriptionspanier ?? []) . ') - VinoTrip')

@section('head')
<link rel="stylesheet" href="/assets/css/panier/panier.css">
@endsection

@section('body')
@include('layout.header')
<main class="container">
    @include('layout.breadcrumb')
    <h1>Votre Panier</h1>
    <hr class="separateur-titre" />

    @error('alert')
        <div class="alert alert-danger">
            <i data-lucide="ban"></i>
            <span class="text">{{ $message }}</span>
        </div>
    @enderror

    @if(session('alert-success'))
        <div class="alert alert-success">
            <i data-lucide="circle-check-big"></i>
            <span class="text">{{ session('alert-success') }}</span>
        </div>
    @endif

    @if ($panier === null || sizeof($panier->descriptionspanier) === 0)
        <div class="alert"><i data-lucide="shopping-cart"></i> Votre panier est vide !</div>
    @else
        <section id="liste-sejours">
            @foreach ($panier->descriptionspanier ?? [] as $descriptionpanier)
                @php
                    $sejour = $descriptionpanier->sejour;
                    $nbPersonnes = $descriptionpanier->nbadultes + $descriptionpanier->nbenfants;
                @endphp
                <article class="descriptionpanier">
                    <form action="{{ route('api.panier.update') }}" method="post">
                        @csrf
                        <input type="hidden" name="iddescriptionpanier" value="{{ $descriptionpanier->iddescriptionpanier }}">
                        <div class="sejour">
                            <h2>{{ $sejour->titresejour }}</h2>
                            <img class="photo" src="/storage/sejour/{{ $sejour->photosejour }}"
                                alt="{{ $sejour->titresejour }}">
                        </div>
                        <table class="details">
                            <tbody>
                                <tr>
                                    <td>Dates</td>
                                    <td colspan="2">Départ
                                        {{ date_format(new DateTime($descriptionpanier->datedebut), 'd/m/Y') }}<br />
                                        Retour {{ date_format(new DateTime($descriptionpanier->datefin), 'd/m/Y') }}
                                    </td>
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
                                        @if (sizeof($descriptionpanier->repas) === 0)
                                            Aucun repas
                                        @endif
                                        @foreach ($descriptionpanier->repas as $repas)
                                            <div>{{ $repas->restaurant->nompartenaire }}</div>
                                        @endforeach
                                    </td>
                                    <td class="prix">
                                        @if (sizeof($descriptionpanier->repas) === 0)
                                            0 €
                                        @endif
                                        @foreach ($descriptionpanier->repas as $repas)
                                            <div>{{ $nbPersonnes }} × {{ $repas->prixrepas }} €</div>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <td>Activités</td>
                                    <td>
                                        @if (sizeof($descriptionpanier->activites) === 0)
                                            Aucune activité
                                        @endif
                                        @foreach ($descriptionpanier->activites as $activite)
                                            <div>{{ $activite->libelleactivite }}</div>
                                        @endforeach
                                    </td>
                                    <td class="prix">
                                        @if (sizeof($descriptionpanier->activites) === 0)
                                            0 €
                                        @endif
                                        @foreach ($descriptionpanier->activites as $activite)
                                            <div>{{ $nbPersonnes }} × {{ $activite->prixactivite }} €</div>
                                        @endforeach
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
                                        {{ $descriptionpanier->offrir && !$descriptionpanier->ecoffret ? 5 : 0 }} €
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="prix-total">
                            <div class="text flex-help">
                                Prix total
                                <div data-help="Le prix est TTC"></div>
                            </div>
                            <span class="prix">
                                {{ number_format($descriptionpanier->prix * $descriptionpanier->quantite, 2, ',', ' ') }}€
                            </span>
                        </div>
                        <div class="infos">
                            @if ($descriptionpanier->codepromoutilise === null)
                                <a class="button" href="{{ route('panier.modifier', ['idsejour' => $descriptionpanier->idsejour]) }}">
                                    <i data-lucide="pencil"></i> Modifier les détails
                                </a>
                                <div class="input-control input-control-text" style="margin: 0">
                                    <input type="number" name="quantite" autocomplete="off" min="1" max="10"
                                        id="quantite-{{ $sejour->idsejour }}" value="{{ $descriptionpanier->quantite }}">
                                </div>
                                @error('quantite')
                                    {{ $message }}
                                @enderror
                                <div class="buttons">
                                    <button class="button" type="submit" name="action" value="update">
                                        <i data-lucide="save"></i>
                                    </button>
                                    <button class="button" type="submit" name="action" value="delete">
                                        <i data-lucide="trash-2"></i>
                                    </button>
                                </div>
                                @error('action')
                                    {{ $message }}
                                @enderror
                            @else
                                <div class="buttons">
                                    <button class="button" type="submit" name="action" value="delete">
                                        <i data-lucide="trash-2"></i>
                                    </button>
                                </div>
                            @endif
                        </div>
                    </form>
                </article>
            @endforeach
        </section>
    @endif

    @if ($panier)
        <div id="total">
            <p class="text">Total du panier</p>
            <p class="prix">{{ number_format($panier->prix, 2, ',', ' ') }} €</p>
            @if ($panier->codepromo)
                <p class="promo-code">{{ $panier->codepromo->libellecodepromo }}</p>
                <p class="promo-reduction">-{{ number_format($panier->reduction, 2, ',', ' ') }} €</p>
            @endif
            <hr>
            <p class="text">Total final</p>
            <p class="prix-final">
                {{ number_format($panier->prixreduit, 2, ',', ' ') }} €
            </p>
        </div>
    @endif

    <div id="buttons-navigation">
        <a href="{{ route('sejours') }}" class="button">Continuer mes achats</a>

        <form action="{{ route('api.panier.promo') }}" method="POST" id="codepromo">
            @csrf
            <div class="input-control input-control-text">
                <input type="text" name="codePromo" placeholder="Code promo" />
            </div>
            <button id="codepr" class="button" type="submit">
                <i data-lucide="percent"></i>
            </button>
        </form>

        @if ($panier !== null && sizeof($panier->descriptionspanier) > 0)
            <a href="{{ route('paiement') }}" class="button">Passer au paiement</a>
        @endif

    </div>
</main>
@include('layout.footer')
