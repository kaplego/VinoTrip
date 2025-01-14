@extends('layout.app')

{{-- @section('title', $sejour->titresejour . ' - VinoTrip') --}}

@section('head')
    <link rel="stylesheet" href="/assets/css/sejours/summary.css">
@endsection

@section('body')
    @include('layout.header')
    @php
        $jour = 1;
        $cpt = 0;
    @endphp
    <main class="container">
        @php
            $bcCustomLink = isset($iddescriptioncommande)
                ? 'reservation/hebergement'
                : "sejour/$sejour->idsejour/edit/hebergement";
            $breadcrumReplaceName = [
                '/sejour' => 'Sejours',
                "/sejour/$sejour->idsejour" => $sejour->titresejour,
            ];
        @endphp
        @include('layout.breadcrumb')
        <section id="hebergements">
            @foreach ($hebergements as $hebergement)
                @if ($hebergement->idhebergement != $idhebergement)
                    <form action="/api/sejour/{{ $sejour->idsejour }}/etape/{{ $etape->idetape }}/hebergement" method="POST">
                        @csrf

                        <article class="hebergement">
                            <img class="imgheberg"
                                src="/assets/images/hebergement/{{ $hebergement->photohebergement }}"></img>
                            <p class="descrheberg">{{ $hebergement->descriptionhebergement }}</p>
                            <a class="lienheberg" href="{{ $hebergement->lienhebergement }}"
                                target="_blank">{{ $hebergement->hotel->nompartenaire }}</a>
                            {{-- {{ $etape->hebergement->lienhebergement }} --}}
                        </article>
                        @isset($iddescriptioncommande)
                            <input type="hidden" name="iddescriptioncommande" value="{{ $iddescriptioncommande }}" />
                        @endisset
                        <input type="hidden" name="newidhebergement" value="{{ $hebergement->idhebergement }}" />
                        <button class="button" type="submit">
                            Choisir cet hébergement
                        </button>
                    </form>
                @endif
            @endforeach
        </section>
    </main>
    @include('layout.footer')
@endsection
