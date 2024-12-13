@extends('layout.app')

@php
    $sejour = $descriptionPanier->sejour;
@endphp

@section('title', 'Modifier - ' . $sejour->titresejour . ' - VinoTrip')

@section('head')
    <link rel="stylesheet" href="/assets/css/panier/personnaliser.css">
@endsection

@section('body')
    @include('layout.header')
    <main class="container-sm">
        @include('layout.breadcrumb')
        <h1>Modifier : {{ $sejour->titresejour }}</h1>
        <hr class="separateur-titre" />
        <form action="/api/panier/add" method="POST" novalidate>
            @csrf
            <input type="hidden" name="idsejour" value="{{ $sejour->idsejour }}">
            <section>
                <h2>Informations</h2>

                <div class="input-group">
                    <div class="input-control input-control-text">
                        <label for="datedebut">Date de départ</label>
                        <input type="date" id="datedebut" name="datedebut"
                            value="{{ old('datedebut', $descriptionPanier->datedebut) }}" min="1" required
                            autocomplete="off" data-duree="{{ $sejour->duree->idduree }}" />
                        @error('datedebut')
                            <p class="alert alert-error"><i data-lucide="circle-x"></i>{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="input-control input-control-text">
                        <label for="datefin">Date de retour</label>
                        <input type="date" id="datefin" name="datefin"
                            value="{{ old('datefin', $descriptionPanier->datefin) }}" min="0" readonly
                            autocomplete="off" />
                        @error('datefin')
                            <p class="alert alert-error"><i data-lucide="circle-x"></i>{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="input-group">
                    <div class="input-control input-control-text">
                        <label for="nbadultes">Adulte</label>
                        <input type="number" id="nbadultes" name="nbadultes"
                            value="{{ old('nbadultes', $descriptionPanier->nbadultes) }}" min="1" required />
                        @error('nbadultes')
                            <p class="alert alert-error"><i data-lucide="circle-x"></i>{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="input-control input-control-text">
                        <label for="nbenfants">Enfants</label>
                        <input type="number" id="nbenfants" name="nbenfants"
                            value="{{ old('nbenfants', $descriptionPanier->nbenfants) }}" min="0" required />
                        @error('nbenfants')
                            <p class="alert alert-error"><i data-lucide="circle-x"></i>{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="input-group">
                    <div class="input-control input-control-text">
                        <label for="chambressimple">Nombre de chambres simple<br /><span class="price">75 € /
                                chambre</span></label>
                        <input type="number" id="chambressimple" name="chambressimple" min="0" max="10" required
                            value="{{ old('chambressimple', $descriptionPanier->nbchambressimple) }}" />
                        @error('chambressimple')
                            <p class="alert alert-error"><i data-lucide="circle-x"></i>{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="input-control input-control-text">
                        <label for="chambresdouble">Nombre de chambres double<br /><span class="price">100 € /
                                chambre</span></label>
                        <input type="number" id="chambresdouble" name="chambresdouble" min="0" max="10" required
                            value="{{ old('chambresdouble', $descriptionPanier->nbchambresdouble) }}" />
                        @error('chambresdouble')
                            <p class="alert alert-error"><i data-lucide="circle-x"></i>{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="input-control input-control-text">
                        <label for="chambrestriple">Nombre de chambres triple<br /><span class="price">125 € /
                                chambre</span></label>
                        <input type="number" id="chambrestriple" name="chambrestriple" min="0" max="10" required
                            value="{{ old('chambrestriple', $descriptionPanier->nbchambrestriple) }}" />
                        @error('chambrestriple')
                            <p class="alert alert-error"><i data-lucide="circle-x"></i>{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </section>

            <section>
                <h2>Options supplémentaires</h2>

                <div class="input-control input-control-checkbox">
                    <input type="checkbox" id="dejeuner" name="dejeuner"
                        {{ old('dejeuner', $descriptionPanier->repasmidi) ? 'checked' : '' }} value="1">
                    <label for="dejeuner">Déjeuner <span class="price">20 € / pers.</span></label>
                    @error('dejeuner')
                        <p class="alert alert-error"><i data-lucide="circle-x"></i>{{ $message }}</p>
                    @enderror
                </div>

                <div class="input-control input-control-checkbox">
                    <input type="checkbox" id="diner" name="diner"
                        {{ old('diner', $descriptionPanier->repassoir) ? 'checked' : '' }} value="1">
                    <label for="diner">Diner <span class="price">20 € / pers.</span></label>
                    @error('diner')
                        <p class="alert alert-error"><i data-lucide="circle-x"></i>{{ $message }}</p>
                    @enderror
                </div>

                <div class="input-control input-control-checkbox">
                    <input type="checkbox" id="activite" name="activite"
                        {{ old('activite', $descriptionPanier->activite) ? 'checked' : '' }} value="1">
                    <label for="activite">Activité <span class="price">50 € / pers.</span></label>
                    @error('activite')
                        <p class="alert alert-error"><i data-lucide="circle-x"></i>{{ $message }}</p>
                    @enderror
                </div>
            </section>

            <section>
                <h2>Cadeau</h2>
                <div class="input-control input-control-checkbox">
                    <input type="checkbox" id="offrir" name="offrir"
                        {{ old('offrir', $descriptionPanier->offrir) ? 'checked' : '' }} value="1">
                    <label for="offrir">Offrir le séjour</label>
                </div>
                @error('offrir')
                    <p class="error" style="margin-bottom: 1rem">{{ $message }}</p>
                @enderror
                <div class="input-control input-control-radio" data-offrir>
                    <input type="radio" id="e-coffret" name="ecoffret" value="1"
                        {{ old('ecoffret', $descriptionPanier->ecoffret) === '1' ? 'checked' : '' }}>
                    <label for="e-coffret">E-Coffret : envoi immédiat par email
                        <span class="price">Gratuit</span></label>
                </div>
                <div class="input-control input-control-radio" data-offrir>
                    <input type="radio" id="coffret-postal" name="ecoffret" value="0"
                        {{ old('ecoffret', $descriptionPanier->ecoffret) !== '1' ? 'checked' : '' }}>
                    <label for="coffret-postal">Coffret : Livraison sous 4 à 6 jours ouvrés
                        <span class="price">5 €</span></label>
                </div>
                @error('ecoffret')
                    <p class="error" data-offrir>{{ $message }}</p>
                @enderror
            </section>
            <p id="prix-total-text">Prix total : <span id="prix-total">{{ $sejour->prixsejour }} €</span></p>
            <button class="button" type="submit">Enregistrer</button>
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
