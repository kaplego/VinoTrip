@extends('layout.app')

@section('title', 'Personnaliser - ' . $sejour->titresejour . ' - VinoTrip')

@section('head')
    <link rel="stylesheet" href="/assets/css/panier/personnaliser.css">
@endsection

@section('body')
    @include('layout.header')
    <main class="container">
        @php
            $breadcrumReplaceLink = [
                '/personnaliser' => '/sejours',
                "/personnaliser/$sejour->idsejour" => "/sejour/$sejour->idsejour",
            ];
            $breadcrumReplaceName = [
                '/personnaliser' => 'Sejours',
                "/personnaliser/$sejour->idsejour" => $sejour->titresejour,
            ];
            $breadcrumLastLink = true;
        @endphp
        @include('layout.breadcrumb')
        <h1>Personnaliser : {{ $sejour->titresejour }}</h1>
        <hr class="separateur-titre" />
        <form action="/api/panier/add" method="POST" novalidate id="formulaire">
            @csrf
            <input type="hidden" name="idsejour" value="{{ $sejour->idsejour }}">
            <section>
                <h2>Informations</h2>

                <div class="input-group">
                    <div class="input-control input-control-text">
                        <label for="datedebut">Date de départ</label>
                        <input type="date" id="datedebut" name="datedebut" value="{{ old('datedebut') }}" min="1"
                            required autocomplete="off" data-duree="{{ $sejour->duree->idduree }}" />
                        @error('datedebut')
                            <p class="alert alert-error"><i data-lucide="circle-x"></i>{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="input-control input-control-text">
                        <label for="datefin">Date de retour</label>
                        <input type="date" id="datefin" name="datefin" value="{{ old('datefin') }}" min="0"
                            readonly autocomplete="off" />
                        @error('datefin')
                            <p class="alert alert-error"><i data-lucide="circle-x"></i>{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="input-group">
                    <div class="input-control input-control-text">
                        <label for="nbadultes">Adultes</label>
                        <input type="number" id="nbadultes" name="nbadultes" value="{{ old('nbadultes', 1) }}"
                            min="1" required />
                        @error('nbadultes')
                            <p class="alert alert-error"><i data-lucide="circle-x"></i>{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="input-control input-control-text">
                        <label for="nbenfants">Enfants</label>
                        <input type="number" id="nbenfants" name="nbenfants" value="{{ old('nbenfants', 0) }}"
                            min="0" required />
                        @error('nbenfants')
                            <p class="alert alert-error"><i data-lucide="circle-x"></i>{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="input-group">
                    <div class="input-control input-control-text">
                        <label for="chambressimple">Nombre de chambres simple<br /><span class="price">75 € /
                                chambre</span></label>
                        <input type="number" id="chambressimple" name="chambressimple" min="0" max="10"
                            required value="{{ old('chambressimple', 0) }}" />
                        @error('chambressimple')
                            <p class="alert alert-error"><i data-lucide="circle-x"></i>{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="input-control input-control-text">
                        <label for="chambresdouble">Nombre de chambres double<br /><span class="price">100 € /
                                chambre</span></label>
                        <input type="number" id="chambresdouble" name="chambresdouble" min="0" max="10"
                            required value="{{ old('chambresdouble', 0) }}" />
                        @error('chambresdouble')
                            <p class="alert alert-error"><i data-lucide="circle-x"></i>{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="input-control input-control-text">
                        <label for="chambrestriple">Nombre de chambres triple<br /><span class="price">125 € /
                                chambre</span></label>
                        <input type="number" id="chambrestriple" name="chambrestriple" min="0" max="10"
                            required value="{{ old('chambrestriple', 0) }}" />
                        @error('chambrestriple')
                            <p class="alert alert-error"><i data-lucide="circle-x"></i>{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </section>

            <section>
                <h2>Hébergement</h2>

                <div class="selections">
                    @foreach ($sejour->etape as $etape)
                        <article class="selection selection-image selection-hebergement"
                            data-value="{{ $etape->hebergement->idhebergement }}"
                            data-price="{{ $etape->hebergement->prixhebergement }}">
                            <input type="radio" name="hebergement" value="{{ $etape->hebergement->idhebergement }}"
                                id="hebergement-{{ $etape->hebergement->idhebergement }}" hidden
                                @if (old('hebergement') == $etape->hebergement->idhebergement) checked @endif>
                            <img class="image"
                                src="/assets/images/hebergement/{{ $etape->hebergement->photohebergement }}"></img>
                            <div class="infos">
                                <p class="titre">{{ $etape->hebergement->hotel->nompartenaire }}</p>
                                <p class="description">{{ $etape->hebergement->descriptionhebergement }}</p>
                                <p class="prix">{{ number_format($etape->hebergement->prixhebergement, 2, ',') }} €</p>
                            </div>
                        </article>
                    @endforeach
                </div>

                @error('hebergement')
                    <p class="alert alert-error"><i data-lucide="circle-x"></i>{{ $message }}</p>
                @enderror
            </section>

            <section>
                <h2>Repas</h2>

                <div class="selections">
                    @foreach ($sejour->etape as $etape)
                        @foreach ($etape->repas as $repas)
                            <article class="selection selection-repas" data-value="{{ $repas->idrepas }}"
                                data-price="{{ $repas->prixrepas }}" id="repas-{{ $repas->idrepas }}">
                                <input type="checkbox" name="repas[]" value="{{ $repas->idrepas }}" hidden
                                    @if (in_array($repas->idrepas, old('repas', []))) checked @endif>
                                <div class="infos">
                                    <p class="titre">{{ $repas->restaurant->nompartenaire }}</p>
                                    <div class="etoiles">
                                        @for ($i = 0; $i < $repas->restaurant->nombreetoilesrestaurant; $i++)
                                            <i data-lucide="star"></i>
                                        @endfor
                                    </div>
                                    <p class="description">{{ $repas->descriptionrepas }}</p>
                                    <p class="prix">{{ number_format($repas->prixrepas, 2, ',') }} €</p>
                                </div>
                            </article>
                        @endforeach
                    @endforeach
                </div>

                @error('repas')
                    <p class="alert alert-error"><i data-lucide="circle-x"></i>{{ $message }}</p>
                @enderror
            </section>

            <section>
                <h2>Activités</h2>

                @foreach ($sejour->etape as $etape)
                    @foreach ($etape->activites as $activite)
                        <div class="input-control input-control-checkbox">
                            <input type="checkbox" name="activites[]" value="{{ $activite->idactivite }}"
                                id="activite-{{ $activite->idactivite }}" class="activite"
                                data-price="{{ $activite->prixactivite }}"
                                @if (in_array($activite->idactivite, old('activites', []))) checked @endif>
                            <label for="activite-{{ $activite->idactivite }}">{{ $activite->libelleactivite }} <span
                                    class="price">{{ number_format($activite->prixactivite, 2, ',') }} € /
                                    personne</span></label>
                            @error("activites.{{ $activite->idactivite }}")
                                <p class="alert alert-error"><i data-lucide="circle-x"></i>{{ $message }}</p>
                            @enderror
                        </div>
                    @endforeach
                @endforeach

                @error('activites')
                    <p class="alert alert-error"><i data-lucide="circle-x"></i>{{ $message }}</p>
                @enderror
            </section>

            <section>
                <h2>Cadeau</h2>
                <div class="input-control input-control-checkbox">
                    <input type="checkbox" id="offrir" name="offrir" {{ old('offrir') ? 'checked' : '' }}
                        value="1">
                    <label for="offrir">Offrir le séjour</label>
                </div>
                @error('offrir')
                    <p class="error" style="margin-bottom: 1rem">{{ $message }}</p>
                @enderror
                <div id="radios-offrir">
                    <div class="input-control input-control-radio">
                        <input type="radio" id="e-coffret" name="ecoffret" value="1"
                            {{ old('ecoffret') === '1' ? 'checked' : '' }}>
                        <label for="e-coffret">E-Coffret : envoi immédiat par email
                            <span class="price">Gratuit</span></label>
                    </div>
                    <div class="input-control input-control-radio">
                        <input type="radio" id="coffret-postal" name="ecoffret" value="0"
                            {{ old('ecoffret') !== '1' ? 'checked' : '' }}>
                        <label for="coffret-postal">Coffret : Livraison sous 4 à 6 jours ouvrés
                            <span class="price">5 €</span></label>
                    </div>
                </div>
                @error('ecoffret')
                    <p class="error" data-offrir>{{ $message }}</p>
                @enderror
            </section>
            <p id="prix-total-text">Prix total : <span
                    id="prix-total">{{ number_format($sejour->prixsejour, 2, ',', ' ') }}
                    €</span></p>
            <button class="button" type="submit">Ajouter au Panier</button>
        </form>
    </main>
    @include('layout.footer')

    <script>
        const prixDeBase = {{ $sejour->prixsejour }};
    </script>
@endsection

@section('scripts')
    <script src="/assets/js/personnaliser.js" defer></script>
@endsection
