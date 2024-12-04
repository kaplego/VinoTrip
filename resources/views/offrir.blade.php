@php
    $active = 'sejours-list';
@endphp
@endphp

@extends('layout.app')

@section('title', 'Séjours - VinoTrip')

@section('head')
    <link rel="stylesheet" href="/assets/css/summary.css">
@endsection

@section('body')
    @include('layout.header')
    <main class="container-sm">
        <h1>Votre Séjour </h1>
        <div>
            <div>
                <label> INFORMATIONS </label>
            </div>
            <div>
                <label>Adulte</label>
                <input type="button" name="moinsAdulte" value="-" />
                <input type="text" name="quantiteAdulte" />
                <input type="button" name="plus" value="+" />
            </div>

            <div>
                <label>Enfants</label>
                <input type="button" name="moins" value="-" />
                <input type="text" name="quantite" />
                <input type="button" name="plus" value="+" />
            </div>
            <div>
                <label>Chambre(s)</label>
                <input type="button" name="moins" value="-" />
                <input type="text" name="quantite" />
                <input type="button" name="plus" value="+" />
            </div>

            <hr />
            <div>
                <label> HEBERGEMENT </label>
            </div>
            <hr />
            <div>
                <label> SÉLECTIONNEZ VOS OPTIONS </label>
            </div>
            <div>
                <label>Déjeuner dégustation </label>
                <div>
                    <input type="radio" id="age3" name="age" value="100">
                    <label> Non <label>
                </div>
                <div>
                    <input type="radio" id="age3" name="age" value="100">
                    <label> Oui <label>
                </div>

                <label>Activités</label>
                <div>
                    <input type="radio" id="age3" name="age" value="100">
                    <label> Fin Gourmet - Côte de Beaune <label>
              </div>
            </div>
            <hr />
            <div>
                <label> SÉLECTIONNEZ VOTRE FORMAT DE CADEAU </label>
            </div>

            <div>
                <div>
                    <input type="radio" id="age3" name="age" value="100">
                    <label> e-coffret - envoi immédiat par email - GRATUIT <label>
                </div>
                <div>
                    <input type="radio" id="age3" name="age" value="100">
                    <label> coffret - livraison sous 4 à 6 jours ouvrés à l’adresse postale de votre choix + envoi immédiat par email<label>
                </div>

          </div>
          <hr />
          <div>
            <label>PERSONNALISEZ VOTRE CADEAU - OFFERT</label>
            <input type="button" name="w" value="Oui" />
            <input type="button" name="s" value="Non" />

        </div>
        <hr />

        </div>




        <div id="infos_etapes_offrir" class="content_prices_box">
            <h4>Comment ça marche ?</h4>
            <p><span class="no color_gamme">1</span> <span class="text">Achetez votre cadeau personnalisé</span></p>
            <p><span class="no color_gamme">2</span> <span class="text">Recevez votre coffret cadeau par mail ou par
                    courrier</span></p>
            <p><span class="no color_gamme">3</span> <span class="text">Offrez !</span></p>
            <br>
            <br>
            <h4>Les plus VINOTRIP</h4>
            <br>
            <p>Des séjours valables 18 mois</p>
            <p>Une prise en charge totale de l'organisation du séjour</p>
            <p>Une équipe de spécialistes du tourisme et du vin à votre disposition</p>
            <p>Des partenaires testés et sélectionnés avec soin</p>
        </div>




    </main>
    @include('layout.footer')

@endsection
