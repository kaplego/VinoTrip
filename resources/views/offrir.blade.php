
@extends('layout.app')

@section('title', 'Séjours - VinoTrip')

@section('head')
    <link rel="stylesheet" href="/assets/css/offrir.css">
@endsection

@section('body')
    @include('layout.header')
    <main class="container-sm">
        <h1>Votre Séjour </h1>
        <div id="informations-section">
            <div id="titre-informations">
                <label>INFORMATIONS</label>
            </div>
            <div id="adulte-section">
                <label>Adulte</label>
                <input type="number" name="moinsAdulte" value="-" />
            </div>

            <div id="enfants-section">
                <label>Enfants</label>
                <input type="number" name="moinsEnfant" value="-" />

            </div>

            <div id="chambres-section">
                <label>Chambre(s)</label>
                <input type="number" name="moinsChambre" value="-" />
            </div>

            <hr />
            <section id="hebergement-section">
                <label>HÉBERGEMENT</label>
                @foreach ($sejour->etape as $etape)
                <article class="unheberg">
                    @foreach ($etape->hebergement as $unhebergement)
                        <img class="imgheberg"
                            src="/assets/images/hebergement/{{ $unhebergement->photohebergement }}"></img>
                        <p class="descrheberg">{{ $unhebergement->descriptionhebergement }}</p>
                    @endforeach
                    @endforeach

            </section>
            <hr />
            <div id="options-section">
                <label>SÉLECTIONNEZ VOS OPTIONS</label>
                <div id="dejeuner-section">
                    <label>Déjeuner dégustation</label>
                    <div>
                        <input type="radio" id="dejeuner-non" name="dejeuner" value="non">
                        <label for="dejeuner-non">Non</label>
                    </div>
                    <div>
                        <input type="radio" id="dejeuner-oui" name="dejeuner" value="oui">
                        <label for="dejeuner-oui">Oui</label>
                    </div>
                </div>

                <div id="activites-section">
                    <label>Activités</label>
                    <div>
                        <input type="radio" id="activite-fin-gourmet" name="activite" value="Fin Gourmet - Côte de Beaune">
                        <label for="activite-fin-gourmet">Fin Gourmet - Côte de Beaune</label>
                    </div>
                </div>
            </div>
            <hr />
            <div id="cadeau-format-section">
                <label>SÉLECTIONNEZ VOTRE FORMAT DE CADEAU</label>
                <div>
                    <input type="radio" id="eco-coffret" name="formatCadeau" value="eco-coffret">
                    <label for="eco-coffret">e-coffret - envoi immédiat par email - GRATUIT</label>
                </div>
                <div>
                    <input type="radio" id="coffret-postal" name="formatCadeau" value="coffret">
                    <label for="coffret-postal">coffret - livraison sous 4 à 6 jours ouvrés à l’adresse postale de votre choix + envoi immédiat par email</label>
                </div>
            </div>
            <hr />
            <div id="personnalisation-section">
                <label>PERSONNALISEZ VOTRE CADEAU - OFFERT</label>
                <input type="button" name="personnalisationOui" value="Oui" />
                <input type="button" name="personnalisationNon" value="Non" />
            </div>
            <hr />

            <div id="prix-section">
                <label>Prix total : {{ $sejour->prixsejour }} €</label>
                <input type="hidden" id="prix-de-base" value="{{ $sejour->prixsejour }}">
                <input type="button" name="offrir" value="Offrir" />

            </div>
        </div>

        <div id="infos-etapes-section">
            <h4>Comment ça marche ?</h4>
            <p><span class="no color_gamme">1</span> <span class="text">Achetez votre cadeau personnalisé</span></p>
            <p><span class="no color_gamme">2</span> <span class="text">Recevez votre coffret cadeau par mail ou par courrier</span></p>
            <p><span class="no color_gamme">3</span> <span class="text">Offrez !</span></p>
            <br>
            <h4>Les plus VINOTRIP</h4>
            <p>Des séjours valables 18 mois</p>
            <p>Une prise en charge totale de l'organisation du séjour</p>
            <p>Une équipe de spécialistes du tourisme et du vin à votre disposition</p>
            <p>Des partenaires testés et sélectionnés avec soin</p>
        </div>
    </main>
    @include('layout.footer')

@endsection
