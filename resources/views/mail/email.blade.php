<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>

<body>

    @switch($type)
        {{-- ok --}}
        @case('hotel')
            <p>Bonjour , nous avons un séjour qui aura lieu le {{ $date }}.</p>
            <p>Merci de nous confirmer la disponibilité de votre hébergement{{ $nom }}.</p>
            <p>Cordialement,<br /><br />
                Service vente Vinotrip</p>
        @break

        {{-- ok --}}
        @case('client')
            <p>Bonjour , suite à la la réservation de votre séjour nous vous informons la validation de votre séjour
                {{ $titre }} prévu le {{ $date }}.</p>
            <p>Afin de terminer la validation de votre sejour merci de régler le prix de votre séjour qui est de :
                {{ $prix }} €.</p>

            <p>Cordialemnt,<br /><br />

                Service vente Vinotrip</p>
        @break

        {{-- ok --}}
        @case('ValidationHebegement')
            <p>Bonjour suite à votre validation et celle du client nous vous confirmons que le séjour aura lieu du
                {{ $datedebut }} au {{ $datefin }} pour {{ $nbadultes }} adultes et {{ $nbenfants }} enfants
                , avec {{ $nbchambressimple }} chambres simples , {{ $nbchambresdouble }} chambres doubles et
                {{ $nbchambrestriple }} chambres triples </p>
            <p>La réservation du séjour est au nom de {{ $nom }} {{ $prenom }}</p>
            <p>L'équipe Vinotrip vous remercie pour votre disponibilité et la qualité de l'accueil offerte au client.</p>
            <p>Cordialement,<br /><br />
                Service Vente Vinotrip</p>
        @break

        @case('ValidationClient')
            <p>Bonjour, nous informons que votre séjour {{ $titre }} a bien été prise en compte et qu'il aura bien lieu
                le du {{ $datedebut }} au {{ $datefin }} pour {{ $nbadultes }} adultes et {{ $nbenfants }}
                enfants </p>
            <p>La réservation du séjour est au nom de {{ $nom }} {{ $prenom }}</p>
            <p>Nous vous rappelons que le séjour dure {{ $jours }} </p>
            <p>Vous serez logés à l'hebergement {{ $titreheberg }}</p>
            @foreach ($repas as $repa)
                <p>Vous mangerez au restaurant : {{ $repa->restaurant->nompartenaire }}
                    {{ $repa->restaurant->nombreetoilesrestaurant }} étoiles </p>
                <p> Spécialité : {{ $repa->restaurant->specialiterestaurant }}</p>
            @endforeach
            <p>L'équipe Vinotrip vous remercie pour votre disponibilité et vous souhaite un agréable séjour.</p>
            <p>Cordialement,<br /><br />
                Service Vente Vinotrip</p>
        @break

        {{-- ok --}}
        @case('PbHeberg')
            <p>Bonjour, </p>
            <p>Suite à la réservation de votre séjour, nous vous informons que l’hébergement : {{ $titrehotelancien }} prévu
                initialement pour votre séjour est malheureusement indisponible. Cependant, nous avons le plaisir de vous
                proposer un nouvel hébergement {{ $titrehotelnouveau }} situé à proximité, qui est en mesure de vous
                accueillir.
                <br>
                Nous vous invitons à nous confirmer si vous acceptez cette alternative afin que nous puissions finaliser les
                arrangements pour votre séjour.
            </p>
            <p>Nous restons à votre disposition pour toute question et vous remercions par avance pour votre compréhension.</p>
            <p>Cordialement,<br /><br />
                Service Vente Vinotrip</p>
        @break

        @case('ReservationRestaurant')
            <p>Bonjour <br>, nous souhaitons vous informer de la reservation d'une table de votre restaurant le
                {{ $datedebut }} pour {{ $nbadultes }} adultes et {{ $nbenfants }} enfants</p>
            <p>La réservation du séjour est au nom de {{ $nom }} {{ $prenom }}</p>
            <p>L'équipe Vinotrip vous remercie pour votre disponibilité et la qualité de l'accueil offerte au client.</p>
            <p>Cordialement,<br /><br />
                Service Vente Vinotrip</p>
        @break

        @case('mdp')
            <p>Bonjour {{ $civilite }} {{ $nom }} {{ $prenom }},</p>
            <p>Nous avons reçu une demande de réinitialisation de votre mot de passe. Pour réinitialiser votre mot de passe,
                cliquez sur le lien ci-dessous :</p>
            <p style="text-align: center;">
                <a href="http://{{ Request::getHttpHost() }}/mdpreset/{{ $token }}">Réinitialiser mon mot de passe</a>
            </p>
        @break

        @case('data')
            <p>Bonjour {{ $civilite }} {{ $nom }} {{ $prenom }},</p>

            <p>Nous vous transmettons ci-joint vos informations personnelles. Si vous souhaitez les supprimer, n'hésitez pas à
                nous contacter en répondant à ce message.</p>

            <p>Nous restons à votre disposition pour toute question ou demande complémentaire.</p>

            <p>Bien cordialement, Vinotrip</p>
        @break

        @default
    @endswitch

</body>

</html>
