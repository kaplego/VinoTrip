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
        @default
    @endswitch

    {{--
    @if ($subject == 'Confirmation de votre reservation')
        Bonjour , nous avons un séjour qui aura lieux le .
        {{$datedebutsejour}}
        Merci de nous confirmer la disponibilité de votre hébergement .
        {{$nompartenaire}}
        Cordialemnt,

        Service vente vinotrip


    @endif

    @if ($mailClient)

        Bonjour , suite à la la réservation de votre séjour nous vous informons la validation de votre séjour {{$titresejour}} prévus le {{$datedebutsejour}}.

        Afin de terminer la validation de votre sejour merci regler le prix de votre séjour qui est de : {{$prix}} €.

        Cordialemnt,

        Service vente vinotrip


    @endif --}}




</body>

</html>
