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
                    @if ($commande->descriptioncommande != null)
                        @if ($commande->descriptioncommande->datedebut >= $dateauj)
                            <h2 class="titresej">{{ $commande->descriptioncommande->sejour->titresejour }}</h2>
                            <section id="unereservation">

                                <p class="date">Date séjour : {{ $commande->descriptioncommande->datedebut }}</p>
                                <article class ="unclient">
                                    <h3>Commande effective du client : {{ $commande->beneficiaire->prenomclient }}
                                        {{ $commande->beneficiaire->nomclient }}</h3>
                                    <form method="POST" action="/api/reservationclient">
                                        @csrf
                                        <input type="hidden" value="{{ $commande->descriptioncommande->datedebut }}"
                                            name="datedebut">
                                        <input type="hidden"
                                            value="{{ $commande->descriptioncommande->sejour->titresejour }}"
                                            name="titre">
                                        <input type="hidden" value="{{ $commande->descriptioncommande->prix }}"
                                            name="prix">

                                        <p>Envoyer un mail de paiement au client: <button type="submit"
                                                @if (!\Session::has('successhotel')) disabled= @endif>{{ $commande->beneficiaire->emailclient }}</button>
                                        </p>
                                        <div>
                                            <p>Validation client :<input type="checkbox" name="validClient" id="validationC"
                                                    @if ($commande->validationclient == true) checked @endif></p>
                                        </div>

                                        @if (\Session::has('successclient'))
                                            <p class="alert alert-success"><i
                                                    data-lucide="circle-check-big"></i>{!! \Session::get('success') !!}</p>
                                        @endif

                                    </form>
                                </article>


                                    <article class="unhotel">
                                        <div class="réponseheberg">
                                            <form method="POST" action="/api/reservationhotel">
                                                @csrf
                                                <input type="hidden" value="{{ $commande->descriptioncommande->datedebut }}"
                                                    name="datedebut">
                                                <input type="hidden" value="{{$commande->descriptioncommande->hebergement->hotel->nompartenaire}}"
                                                    name="nom">
                                                <h3>Partenaire hotel : {{ $commande->descriptioncommande->hebergement->hotel->nompartenaire }}</h3>
                                                <p>Envoyer un mail de validation pour la réservation de l'hotel: <button
                                                        type="submit">{{ $commande->descriptioncommande->hebergement->hotel->mailpartenaire }}</button>
                                                </p>
                                                <p>Validation hebergement : <button class="button" type="submit">OUI</button>
                                                    @php
                                                        $commande->descriptioncommande->disponibilitehebergement = true;
                                                        $commande->descriptioncommande->update();
                                                    @endphp</p>
                                                    {{-- <input type="checkbox" name="validHeberg" id="validationH" @if ($commande->validationhebergement == true) checked  @endif > --}}

                                            </form>
                                            <form action="/edit/choix" method="POST">
                                                @csrf
                                                <input type="hidden"
                                                    value="{{ $commande->descriptioncommande->iddescriptioncommande }}"
                                                    name="iddescriptioncommande">
                                                <button class="button" type="submit">NON</button>
                                            </form>
                                        </div>
                                        @if (\Session::has('successhotel'))
                                        @php
                                            $commande->descriptioncommande->disponibilitehebergement = true;
                                            $commande->descriptioncommande->update();
                                        @endphp
                                        <p class="alert alert-success"><i
                                                data-lucide="circle-check-big"></i>{!! \Session::get('success') !!}</p>
                                    @endif
                                    </article>

                            </section>
                            @if (\Session::has('successclient'))
                                <form method="POST" action="/api/reservationhotel" class="validationsejour">
                                    @csrf
                                    <button class="button" type="submit">Valider séjour</button>
                                </form>
                            @endif

                            <br>
                        @endif
                    @endif


                @endforeach
            </section>





        </main>




        @include('layout.footer')

    @endsection

    @section('scripts')

    @endsection
