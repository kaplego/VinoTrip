    @php
        $active = 'reservations';
    @endphp

    @extends('layout.app')

    @section('title', 'Séjours - VinoTrip')

    @section('head')
        <link rel="stylesheet" href="/assets/css/reservation.css">
    @endsection

    @section('body')
        @include('layout.header')

        <main class="container">

            <h1>Réservation clients</h1>
            <hr class="separateur-titre" />

            @php
                $dateauj = date('Y-n-j');
            @endphp
            <section>
                @foreach ($commandes as $commande)
                    @foreach ($commande->descriptionscommande as $descriptioncommande)
                        @if ($descriptioncommande != null && $commande->etatcommande == 'En attente de validation')
                            @if ($descriptioncommande->datedebut >= $dateauj)
                                <section class="reservation">
                                    <h2 class="titre">{{ $descriptioncommande->sejour->titresejour }}</h2>
                                    <p class="date">Date du séjour :
                                        {{ date('D j F Y', strtotime($descriptioncommande->datedebut)) }}</p>

                                    <article class="client">
                                        <h3>Client :
                                            {{ ($commande->beneficiaire ?? $commande->acheteur)->prenomclient }}
                                            {{ ($commande->beneficiaire ?? $commande->acheteur)->nomclient }}</h3>

                                        <form method="POST" action="{{ route('api.reserv.client') }}"
                                            class="boutons-container">
                                            @csrf
                                            <input type="hidden" value="{{ $descriptioncommande->datedebut }}"
                                                name="datedebut">
                                            <input type="hidden" value="{{ $descriptioncommande->sejour->titresejour }}"
                                                name="titre">
                                            <input type="hidden" value="{{ $descriptioncommande->prix }}" name="prix">

                                            <p>Envoyer un mail de paiement au client</p>
                                            <button class="button button-sm" type="submit"
                                                @if ($descriptioncommande->disponibilitehebergement == false) disabled @endif>
                                                {{ ($commande->beneficiaire ?? $commande->acheteur)->emailclient }}
                                            </button>
                                        </form>
                                        <div class="boutons-container">
                                            <p>Validation du client</p>

                                            <div class="boutons">
                                                <form method="POST" action="{{ route('api.clientok') }}">
                                                    @csrf
                                                    <input type="hidden"
                                                        value="{{ $descriptioncommande->iddescriptioncommande }}"
                                                        name="unedescription">
                                                    <button class="button button-sm button-check" type="submit">
                                                        <i data-lucide="check"></i>
                                                    </button>
                                                </form>

                                                <form method="POST" action="{{ route('api.clientnon') }}">
                                                    @csrf
                                                    <input type="hidden" value="{{ $commande->idcommande }}"
                                                        name="unecommande">
                                                    <button class="button button-sm button-x" type="submit">
                                                        <i data-lucide="x"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </article>

                                    {{-- envoie mail heberg --}}
                                    <article class="hotel">
                                        <h3>Hôtel :
                                            {{ $descriptioncommande->hebergement->hotel->nompartenaire }}</h3>

                                        <div class="boutons-container">
                                            <form method="POST" action="{{ route('api.reserv.hotel') }}"
                                                class="boutons-container">
                                                @csrf
                                                <input type="hidden" value="{{ $descriptioncommande->datedebut }}"
                                                    name="datedebut">
                                                <input type="hidden"
                                                    value="{{ $descriptioncommande->hebergement->hotel->nompartenaire }}"
                                                    name="nom">
                                                <p>Envoyer un mail de validation à l'hotel</p>
                                                <button class="button button-sm" type="submit">
                                                    {{ $descriptioncommande->hebergement->hotel->mailpartenaire }}
                                                </button>

                                            </form>
                                        </div>

                                        <div class="boutons-container">
                                            <p>Validation hebergement</p>

                                            {{-- met la variable validationbhebergement à true --}}
                                            <div class="boutons">
                                                <form method="POST" action="{{ route('api.reserv.ok') }}">
                                                    @csrf
                                                    <input type="hidden"
                                                        value="{{ $descriptioncommande->iddescriptioncommande }}"
                                                        name="unedescription">
                                                    <button class="button button-sm button-check" type="submit">
                                                        <i data-lucide="check"></i>
                                                    </button>
                                                </form>

                                                {{-- envoie mail nouvelle heberg --}}
                                                <form
                                                    action="{{ route('api.sejour-hebergement-edit', [
                                                        'idsejour' => $descriptioncommande->idsejour,
                                                        'idetape' => $descriptioncommande->hebergement->etapes[0]->idetape,
                                                    ]) }}"
                                                    method="POST">
                                                    @csrf
                                                    <input type="hidden"
                                                        value="{{ $descriptioncommande->iddescriptioncommande }}"
                                                        name="iddescriptioncommande">
                                                    <input type="hidden"
                                                        value="{{ $descriptioncommande->hebergement->hotel->idpartenaire }}"
                                                        name="idpart">
                                                    <input type="hidden"
                                                        value="{{ $descriptioncommande->iddescriptioncommande }}"
                                                        name="unedescription"></p>
                                                    <button class="button button-sm button-x" type="submit">
                                                        <i data-lucide="x"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                        {{-- @if (\Session::has('successhotel'))

                                            <p class="alert alert-success"><i
                                                    data-lucide="circle-check-big"></i>{!! \Session::get('success') !!}</p>
                                            @endif --}}
                                    </article>

                                </section>
                                @if ($descriptioncommande->disponibilitehebergement = true && $descriptioncommande->validationclient == true)
                                    <form method="POST"
                                        action="{{ route('api.commande.confirm', ['idclient' => $commande->idclientbeneficiaire, 'iddescriptioncommande' => $iddescriptioncommande->ididdescriptioncommande]) }}
                                        class="validationsejour">
                                        @csrf
                                        <button class="button" type="submit">Valider séjour</button>
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
