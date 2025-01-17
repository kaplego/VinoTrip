@extends('layout.app')

@section('title', 'Mentions Légales - VinoTrip')

@section('head')
    <link rel="stylesheet" href="/assets/css/legal.css">
@endsection

@section('body')
    @include('layout.header')

    <main class="container-sm">
        @include('layout.breadcrumb')
        <h1>Mentions légales</h1>
        <hr />

        <h2>1. Editeur</h2>

        <p>Ce site est édité par VINOTRIP S.A.S., société par actions simplifiée au capital de 42.033€, inscrite au registre
            du commerce et des sociétés de Bordeaux sous le numéro 792 620 262 (code APE 7911Z), dont le siège social est
            situé au 9 rue Lamolinerie, 33200 Bordeaux. VINOTRIP S.A.S. est titulaire du certificat d'Immatriculation Atout
            France IM075130039 et est assurée auprès de HISCOX - Assurance RCP contrat n°HA RCP0232580 (tous dommages
            confondus à hauteur de 1 500 000 €).
            La direction de la publication est assurée par Adrien Mirguet en sa qualité de Président de VINOTRIP S.A.S. et
            Julien Plaud en sa qualité de Directeur Général de VINOTRIP S.A.S..</p>

        <h2>2. Propriété intellectuelle</h2>

        <p>Toute représentation totale ou partielle de ce site ou de son contenu (structure générale, textes, sons, logos,
            images animées ou non), par quelques procédés que se soit, sans autorisation préalable et express de VINOTRIP
            S.A.S. est interdite et constituerait une contrefaçon sanctionnée par le code de la Propriété Intellectuelle.
        </p>

        <h2>3. Données personnelles</h2>

        <p>Les informations recueillies font l'objet d'un traitement informatique destiné à VINOTRIP S.A.S. et peuvent être
            transmises à des tiers.
            Conformément à la loi « informatique et libertés » du 6 janvier 1978 modifiée en 2004, vous bénéficiez d'un
            droit d'accès et de rectification aux informations qui vous concernent, que vous pouvez exercer en vous
            adressant à « Données Personnelles - VINOTRIP S.A.S. - Service clients, 9 rue Lamolinerie, 33200 Bordeaux ».
            Vous pouvez également, pour des motifs légitimes, vous opposer au traitement des données vous concernant.
            VINOTRIP S.A.S. propose gratuitement aux internautes qui le souhaitent de s'inscrire à un service appelé «
            Newsletter ». Cette lettre a, avant tout, un but pédagogique et informatif. Elle contient des informations
            permettant aux internautes de mieux utiliser le site et met en avant les nouveautés de celui-ci. Conformément à
            la loi pour la « confiance dans l'économie numérique » (articles L. 33-4-1 du code des postes et communications
            électroniques et L. 121-20-5 du code de la consommation), à la loi « informatique et libertés » modifiée le 6
            août 2004 et aux recommandations de la CNIL, nous proposons aux internautes qui ne souhaitent plus recevoir la
            Newsletter de se désabonner d'un simple clic.</p>
        <p>Pour plus d'information rendez-vous sur notre page de <a href="{{ route('legal.confidentialite') }}">Politique de Confidentialité</a>.</p>

        <h2>4. Questions Techniques</h2>

        <p>Vous pouvez nous adresser toutes les questions techniques liées à ce site par e-mail à l'adresse
            contact@vinotrip.com</p>

        <h2>5. Hébergement</h2>

        <p>Ce site est hébergé par la société OVH S.A.S. au capital de 10.000.000€, RCS Roubaix - Tourcoing 424 761 419
            00045, Code APE 6202A, N° TVA : FR 22 424 761 419, siège social : 2 rue Kellermann 59100 Roubaix - France
            (téléphone : 0 820 698 765).</p>

    </main>
    @include('layout.footer')
@endsection
