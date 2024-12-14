<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>

<body>

    @switch($type)
        @case('hotel')
            <p>Bonjour , nous avons un séjour qui aura lieux le {{ $date }}.</p>
            <p>Merci de nous confirmer la disponibilité de votre hébergement{{ $nom }}.</p>
            <p>Cordialement,<br /><br />
                Service vente vinotrip</p>
        @break
        @case('client')


            <p>Bonjour , suite à la la réservation de votre séjour nous vous informons la validation de votre séjour {{$titre}} prévus le {{$date}}.</p>
              <p>Afin de terminer la validation de votre sejour merci regler le prix de votre séjour qui est de : {{$prix}} €.</p>

             <p>Cordialemnt,<br /><br />

             Service vente vinotrip</p>



        @break

        {{-- @case('ValidationHebegement')
        <p>Bonjour suite à votre validation et celle du client nous vous confirmons que le séjour aura lieux le du {{ $datedebut }} au {{ $datefin }} pour {{$nbadulte}} et @if ({{$nbenfant}}!=0) {{$nbenfant}} enfants @endif</p>
        <p>La réservation du séjour est au nom de {{$nomclient}}</p>
        <p>L'équipe Vinotrip vous remercie pour votre disponibilité et la qualité de l'accueil offert au client.</p>
        <p>Cordialement,<br /><br />
            Service vente vinotrip</p>

        @break

        @case('ValidationClient')
            <p>Bonjour, nous informons que votre séjour à bien été pris en compte et qu'il aura bien lieux le du {{ $datedebut }} au {{ $datefin }} pour {{$nbadulte}} et @if ({{$nbenfant}}!=0) {{$nbenfant}} enfants @endif</p>
            <p>La réservation du séjour est au nom de {{$nomclient}}</p>
            <p>Nous vous rappelons que le séjour dure {{$jours}} </p>

            <p>L'équipe Vinotrip vous remercie pour votre disponibilité et la qualité de l'accueil offert au client.</p>
            <p>Cordialement,<br /><br />
                Service vente vinotrip</p>
        @break --}}


         {{-- @case('PbHeberg')
        <p>Bonjour, </p>
        <p>Suite à la réservation de votre séjour, nous vous informons que l’hébergement : {{$titreheberg}} prévu initialement pour votre séjour est malheureusement indisponible. Cependant, nous avons le plaisir de vous proposer un nouvel hébergement situé à proximité, qui est en mesure de vous accueillir.
            <br>
            Nous vous invitons à nous confirmer si vous acceptez cette alternative afin que nous puissions finaliser les arrangements pour votre séjour.</p>
        <p>Nous restons à votre disposition pour toute question et vous remercions par avance pour votre compréhension.</p>
        <p>Cordialement,<br /><br />
            Service vente vinotrip</p>

        @break --}}

        @default
    @endswitch

</body>

</html>
