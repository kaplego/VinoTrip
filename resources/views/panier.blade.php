@extends('layout.app')

@section('head')
    <link rel="stylesheet" href="/assets/css/panier.css">
@endsection

@section('body')
    @include('layout.header')
    <main class="container-sm">
        <h1>Votre Séjour</h1>
        <hr class="separateur-titre" />

        <section id="liste-sejours">
            @foreach ($panier->descriptionspanier ?? [] as $descriptionpanier)
                @php
                    $sejour = $descriptionpanier->sejour;
                @endphp
                <article class="sejour">
                        @csrf
                        {{-- <section>
                        <h2>Informations</h2>
                        <div>
                            <div class="info">
                                <label for="adults" class="form-label">Adultes</label>
                                <input type="number" id="adults" name="adults" class="form-control"
                                    value="{{ $descriptionpanier->nbadultes }}" min="1" />
                            </div>
                            <div class="info">
                                <label for="children" class="form-label">Enfants</label>
                                <input type="number" id="children" name="children" class="form-control"
                                    value="{{ $descriptionpanier->nbenfants }}" min="0" />
                            </div>
                            <div class="info">
                                <label for="chambres-simples" class="form-label">Chambres simple</label>
                                <input type="number" id="chambres-simples" name="chambres-simples" class="form-control"
                                    value="{{ $descriptionpanier->nbchambressimple }}" min="0" />
                            </div>
                            <div class="info">
                                <label for="chambres-double" class="form-label">Chambres double</label>
                                <input type="number" id="chambres-double" name="chambres-double" class="form-control"
                                    value="{{ $descriptionpanier->nbchambresdouble }}" min="0" />
                            </div>
                            <div class="info">
                                <label for="chambres-triple" class="form-label">Chambres triple</label>
                                <input type="number" id="chambres-triple" name="chambres-triple" class="form-control"
                                    value="{{ $descriptionpanier->nbchambrestriple }}" min="0" />
                            </div>
                        </div>
                    </section> --}}
                    <div class="infos">
                        <img class="photo" src="/assets/images/sejour/{{ $sejour->photosejour }}" alt="{{ $sejour->titresejour }}">
                        <h2>{{ $sejour->titresejour }}</h2>
                    </div>
                </article>
            @endforeach
        </section>

        <aside class="mt-5">
            <h2>Étapes de réservation</h2>
            <ol>
                <li>Vous confirmez votre demande de réservation. Nous revenons vers vous sous 24h après validation des
                    disponibilités auprès de nos partenaires.</li>
                <li>Vous payez en ligne.</li>
                <li>Vous recevez votre carnet de route contenant toutes les informations pratiques (heures de rendez-vous,
                    adresses...).</li>
            </ol>
            <p><strong>Bon voyage !</strong></p>
        </aside>
    </main>
    @include('layout.footer')
