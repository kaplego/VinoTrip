    @php
        $active = 'reservation-sejours';
    @endphp

    @extends('layout.app')

    @section('title', 'Séjours - VinoTrip')

    @section('head')
        <link rel="stylesheet" href="/assets/css/reservation.css">
    @endsection

    @section('body')
        @include('layout.header')

        <main class="container-lg">

            <h1>Réservation clients</h1>
            @php
                $dateauj = date('Y-n-j');

            @endphp
            <section>
                @foreach ($commandes as $commande)
                    @foreach ($commande->descriptionscommande as $descriptioncommande)


                        @if ($descriptioncommande != null)
                            @if ($descriptioncommande->datedebut >= $dateauj)
                                <h2 class="titresej">{{ $descriptioncommande->sejour->titresejour }}</h2>
                                <section id="unereservation">
                                    <p class="date">Date séjour : {{ $descriptioncommande->datedebut }}</p>
                                    <article class ="unclient">
                                        <h3>Commande effective du client : {{ $commande->beneficiaire->prenomclient }}
                                            {{ $commande->beneficiaire->nomclient }}</h3>

                                            {{-- envoie  mail conf client --}}
                                        <form method="POST" action="/api/reservationclient">
                                            @csrf
                                            <input type="hidden" value="{{ $descriptioncommande->datedebut }}"
                                                name="datedebut">
                                            <input type="hidden"
                                                value="{{ $descriptioncommande->sejour->titresejour }}"
                                                name="titre">
                                            <input type="hidden" value="{{ $descriptioncommande->prix }}"
                                                name="prix">

                                            <p>Envoyer un mail de paiement au client: <button type="submit"
                                                    @if ($descriptioncommande->disponibilitehebergement == false) disabled @endif>{{ $commande->beneficiaire->emailclient }}</button>
                                            </p>

                                            {{-- @if (\Session::has('successclient'))
                                                <p class="alert alert-success"><i
                                                        data-lucide="circle-check-big"></i>{!! \Session::get('success') !!}</p>
                                            @endif --}}


                                        </form>
                                        {{-- met la variable validation client à true --}}

                                        <form method="POST" action="/api/clientok">
                                            @csrf
                                            <p>Validation Client : <button class="button" type="submit">OUI</button>
                                                <input type="hidden" value="{{ $descriptioncommande->iddescriptioncommande }}"
                                                name="unedescription"></p>

                                        </form>
                                    </article>

                                        {{-- envoie mail heberg --}}
                                        <article class="unhotel">
                                            <div class="réponseheberg">
                                                <form method="POST" action="/api/reservationhotel">
                                                    @csrf
                                                    <input type="hidden" value="{{ $descriptioncommande->datedebut }}"
                                                        name="datedebut">
                                                    <input type="hidden" value="{{$descriptioncommande->hebergement->hotel->nompartenaire}}"
                                                        name="nom">
                                                    <h3>Partenaire hotel : {{ $descriptioncommande->hebergement->hotel->nompartenaire }}</h3>
                                                    <p>Envoyer un mail de validation pour la réservation de l'hotel: <button
                                                            type="submit">{{ $descriptioncommande->hebergement->hotel->mailpartenaire }}</button>
                                                    </p>


                                                </form>

                                                {{-- met la variable validatiobhebergement à true --}}
                                                <form method="POST" action="/api/reservationok">
                                                    @csrf
                                                    <p>Validation hebergement : <button class="button" type="submit">OUI</button>
                                                        <input type="hidden" value="{{ $descriptioncommande->iddescriptioncommande }}"
                                                        name="unedescription"></p>

                                                </form>

                                                {{-- envoie mail nouvelle heberg --}}
                                                <form action="/edit/choix" method="POST">
                                                    @csrf
                                                    <input type="hidden"
                                                        value="{{ $descriptioncommande->iddescriptioncommande }}"
                                                        name="iddescriptioncommande">
                                                        <input type="hidden"
                                                        value="{{ $descriptioncommande->hebergement->hotel->idpartenaire }}"
                                                        name="idpart">
                                                    <button class="button" type="submit">NON</button>
                                                    <input type="hidden" value="{{ $descriptioncommande->iddescriptioncommande }}"
                                                    name="unedescription"></p>
                                                </form>
                                            </div>
                                            {{-- @if (\Session::has('successhotel'))

                                            <p class="alert alert-success"><i
                                                    data-lucide="circle-check-big"></i>{!! \Session::get('success') !!}</p>
                                            @endif --}}
                                        </article>

                                </section>
                                @if ($descriptioncommande->disponibilitehebergement = true && $descriptioncommande->validationclient==true)
                                    <form method="POST" action="/api/validationcommande" class="validationsejour">
                                        @csrf
                                        <button class="button" type="submit">Valider séjour</button>
                                        <input type="hidden" value="{{ $descriptioncommande->iddescriptioncommande }}"
                                                        name="unedescription"></p>
                                        <input type="hidden" value="{{ $commande->idclientbeneficiaire }}"
                                        name="unclient"></p>
                                        {{-- <p>{{ $descriptioncommande->repas->restaurant->idpartenaire }}</p> --}}

                                    </form>
                                @endif

                                <br>
                            @endif
                        @endif
                    @endforeach

                @endforeach
            </section>





        </main>




        @include('layout.footer')

    @endsection

    @section('scripts')

    @endsection
