@extends('layout.app')

@section('title', 'Politique de Confidentialité - VinoTrip')

@section('head')
    <link rel="stylesheet" href="/assets/css/legal.css">
@endsection

@section('body')
    @include('layout.header')

    <main class="container-sm">
        <h1>Politique de confidentialité</h1>
        <nav id="titre">
            <hr />
        </nav>

        <h2>1. Introduction</h2>

        <p>Dans le cadre de son activité, la société Vinotrip, dont le siège social est situé au 9 rue Lamolinerie, 33200
            Bordeaux,
            est amenée à collecter et à traiter des informations dont certaines sont qualifiées de « données personnelles
            ». Vinotrip attache une grande importance au respect de la vie privée, et n'utilise que des donnes de manière
            responsable et confidentielle et dans une finalité précise.</p>

        <h2>2. Données personnelles</h2>

        <p>Sur le site web Vinotrip.fr, il y a 2 types de données susceptibles d'être recueillies :</p>

        <ul>
            <li>
                <h4>Les données transmises directement</h4>
            </li>
        </ul>

        <p>Ces données sont celles que vous nous transmettez directement, via un formulaire de contact ou bien par
            contact
            direct par email. Sont obligatoires dans le formulaire de contact le champs « prénom et nom », « entreprise
            ou
            organisation » et « email ».</p>

        <ul>
            <li>
                <h4>Les données collectées automatiquement</h4>
            </li>
        </ul>

        <p>Lors de vos visites, une fois votre consentement donné, nous pouvons recueillir des informations de type «
            web
            analytics » relatives à votre navigation, la durée de votre consultation, votre adresse IP, votre type et
            version de
            navigateur. La technologie utilisée est le cookie.</p>

        <h2>3. Utilisation des données</h2>

        <p>Les données que vous nous transmettez directement sont utilisées dans le but de vous re-contacter et/ou dans
            le
            cadre de la demande que vous nous faites. Les données « web analytics » sont collectées de forme anonyme (en
            enregistrant des adresses IP anonymes) par Matomo, et nous permettent de mesurer l'audience de notre site
            web, les
            consultations et les éventuelles erreurs afin d'améliorer constamment l'expérience des utilisateurs. Ces
            données
            sont utilisées par Vinotrip, responsable du traitement des données, et ne seront jamais cédées à un tiers ni
            utilisées à d'autres fins que celles détaillées ci-dessus.</p>

        <h2>4. Base légale</h2>

        <p>Les données personnelles ne sont collectées qu'après consentement obligatoire de l'utilisateur. Ce
            consentement est
            valablement recueilli (boutons et cases à cocher), libre, clair et sans équivoque.</p>

        <h2>5. Durée de conservation</h2>

        <p>Les données seront sauvegardées pour une durée maximale de 3 ans en cas d'inactivité.</p>

        <h2>6. Cookies</h2>

        <p>Voici la liste des cookies utilisées et leur objectif :</p>

        <p>Cookies Matomo : Web analytics

            Matomo : Permet de garder en mémoire le fait que vous acceptez les cookies afin de ne plus vous importuner
            lors de
            votre prochaine visite.
        </p>

        <p>Vos droits concernant les données personnelles
            Vous avez le droit de consultation, demande de modification ou d'effacement sur l'ensemble de vos données
            personnelles. Vous pouvez également retirer votre consentement au traitement de vos données.</p>

        <h2>7. Contact délégué à la protection des données</h2>

        <p>BARRY Titouan</p>
        <ul id="maildpo">
            <li>dpo@vinotrip.fr</li>
            <li>titouan.barry@vinotrip.fr</li>
        </ul>


    </main>
    @include('layout.footer')
@endsection
