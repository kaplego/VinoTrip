@extends('layout.app')

@section('title', 'Séjours - VinoTrip')

@section('head')
    <link rel="stylesheet" href="/assets/css/personnaliser.css">
@endsection

@section('body')
    @include('layout.header')
    <main class="container-sm">
        <h1>Votre Séjour</h1>
        <hr class="separateur-titre" />
        <form action="/api/panier/add" method="POST" novalidate>
            @csrf
            <input type="hidden" name="idsejour" value="{{ $sejour->idsejour }}">
            <section>
                <h2>Informations</h2>

                <div class="input-control input-control-text">
                    <label>Adulte</label>
                    <input type="number" name="nbadultes" value="1" min="1" required />
                    @error('nbadultes')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="input-control input-control-text">
                    <label>Enfants</label>
                    <input type="number" name="nbenfants" value="0" min="0" required />
                    @error('nbenfants')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="input-control input-control-text">
                    <label>Nombre de chambres simple</label>
                    <input type="number" name="chambressimple" value="0" min="0" required />
                    @error('chambressimple')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="input-control input-control-text">
                    <label>Nombre de chambres double</label>
                    <input type="number" name="chambresdouble" value="0" min="0" required />
                    @error('chambresdouble')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="input-control input-control-text">
                    <label>Nombre de chambres triple</label>
                    <input type="number" name="chambrestriple" value="0" min="0" required />
                    @error('chambrestriple')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
            </section>

            {{-- <section>
                <h2>Hébergement</h2>

                <div id="hebergements">
                    @foreach ($sejour->etape as $etape)
                        @foreach ($etape->hebergement as $hebergement)
                            <article class="hebergement" data-value="{{ $hebergement->idhebergement }}">
                                <img class="image"
                                    src="/assets/images/hebergement/{{ $hebergement->photohebergement }}"></img>
                                <div class="infos">
                                    <p class="titre">{{ $hebergement->hotel->nompartenaire }}</p>
                                    <p class="description">{{ $hebergement->descriptionhebergement }}</p>
                                </div>
                            </article>
                        @endforeach
                    @endforeach
                </div>

                <select name="hebergement" id="hebergement" hidden>
                    @foreach ($sejour->etape as $etape)
                        @foreach ($etape->hebergement as $hebergement)
                            <option value="{{ $hebergement->idhebergement }}"></option>
                        @endforeach
                    @endforeach
                </select>
            </section> --}}

            <section>
                <h2>Sélectionnez vos options</h2>

                <div class="input-control input-control-checkbox">
                    <input type="checkbox" id="dejeuner" name="dejeuner">
                    <label for="dejeuner">Déjeuner</label>
                    @error('dejeuner')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="input-control input-control-checkbox">
                    <input type="checkbox" id="diner" name="diner">
                    <label for="diner">Diner</label>
                    @error('diner')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
            </section>

            <section>
                <h2>Activités</h2>

                <select name="activites" id="activites" hidden multiple>
                    @foreach ($sejour->etape as $etape)
                        @foreach ($etape->activites as $activite)
                            <option value="{{ $activite->idactivite }}"></option>
                        @endforeach
                    @endforeach
                </select>

                @foreach ($sejour->etape as $etape)
                    @foreach ($etape->activites as $activite)
                        <div class="input-control input-control-checkbox">
                            <input type="checkbox" name="activites[{{ $activite->idactivite }}]"
                                id="activite-{{ $activite->idactivite }}">
                            <label for="activite-{{ $activite->idactivite }}">{{ $activite->libelleactivite }}</label>
                        </div>
                    @endforeach
                @endforeach

                @error('activites')
                    <p class="error">{{ $message }}</p>
                @enderror
            </section>

            <section>
                <h2>Cadeau</h2>
                <div class="input-control input-control-checkbox">
                    <input type="checkbox" id="offrir" name="offrir">
                    <label for="offrir">Offrir le séjour</label>
                </div>
                <div class="input-control input-control-radio" data-offrir>
                    <input type="radio" id="e-coffret" name="formatCadeau" value="e-coffret" checked="true">
                    <label for="e-coffret">E-Coffret : envoi immédiat par email (GRATUIT)</label>
                </div>
                <div class="input-control input-control-radio" data-offrir>
                    <input type="radio" id="coffret-postal" name="formatCadeau" value="coffret">
                    <label for="coffret-postal">Coffret : Livraison sous 4 à 6 jours ouvrés</label>
                </div>
            </section>
            <p id="prix-total-text">Prix total : <span id="prix-total">{{ $sejour->prixsejour }} €</span></p>
            <button class="button" type="submit">Ajouter au Panier</button>
        </form>
    </main>
    @include('layout.footer')

    <script>
        const prixDeBase = {{ $sejour->prixsejour }};
    </script>
@endsection

@section('scripts')
    <script src="/assets/js/personnaliser.js"></script>
@endsection
