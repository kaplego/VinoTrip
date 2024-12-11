    @php
        $active = 'reservation-sejours';
    @endphp

    @extends('layout.app')

    @section('title', 'Séjours - VinoTrip')

    @section('head')
        {{-- <link rel="stylesheet" href="/assets/css/sejours/sejours.css"> --}}
    @endsection

    @section('body')
        @include('layout.header')

        <main class="container-lg">

            <h1>Réservation clients</h1>

            @foreach ($commandes as $commande)
                <p>{{$commande->beneficiaire->prenomclient}}</p>
                <p>{{$commande->beneficiaire->nomclient}}</p>
                <p>{{$commande->beneficiaire->emailclient}}</p>
                {{-- <p>{{$commande->descriptioncommande!=null ? $commande->descriptioncommande->datedebut : "" }}</p> --}}
                @if($commande->descriptioncommande!=null)
                    @foreach ( $commande->descriptioncommande->sejour->etape as $unetape)
                    <form method="POST" action="/api/reservation">
                        @csrf
                        <input type="hidden" value="{{$unetape->hebergement->hotel->mailpartenaire}}" name="mailpartenaire">
                        <p>Envoyer un mail de validation  : <button type="submit">{{$unetape->hebergement->hotel->mailpartenaire}}</button> </p>

                    </form>

                    @endforeach

                @endif
                <br>

            @endforeach


            <h1>Réservation hotel partenaire</h1>


        </main>




        @include('layout.footer')

    @endsection

    @section('scripts')
        {{-- <script src="/assets/js/sejours.js"></script> --}}
    @endsection

