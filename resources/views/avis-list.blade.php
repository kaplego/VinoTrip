@extends('layout.app')

@section('title', 'Avis - VinoTrip')

@section('head')
    <link rel="stylesheet" href="/assets/css/welcome.css">
@endsection

@section('body')
    @include('layout.header')
    <main class="container-sm">
        @include('layout.breadcrumb')
        <h1>Avis des voyageurs</h1>
        <hr id="ligne">
        <section id="avis">
            @foreach ($listeSejour as $sejour)
                @php
                    $note = 0;
                @endphp
                @foreach ($sejour->avis as $avis)
                    @php
                        $note += $avis->noteavis;
                    @endphp
                @endforeach
                @php
                    $note = $note / sizeof($sejour->avis);
                    $note = round($note, 1);
                @endphp
                <article class="avis">
                    <h2 class="titre-avis">{{ $sejour->titresejour }}</h2>
                    <div class="note">
                        <p class="etoiles">
                            <i data-lucide="star" fill="currentColor" class="checked"></i>
                            <i data-lucide="star" fill="currentColor"
                                class="@if ($note >= 2) checked @endif"></i>
                            <i data-lucide="star" fill="currentColor"
                                class="@if ($note >= 3) checked @endif"></i>
                            <i data-lucide="star" fill="currentColor"
                                class="@if ($note >= 4) checked @endif"></i>
                            <i data-lucide="star" fill="currentColor"
                                class="@if ($note == 5) checked @endif"></i>
                        </p>
                        <p class="valeur">{{ number_format($note, 1, ',') }}/5 ({{ sizeof($sejour->avis) }} avis)</p>
                    </div>

                    <div class="exemple-avis">
                        <p class="titre-exemple">{{ $sejour->avis[0]->titreavis }}</p>
                        <p class="description-exemple">{{ $sejour->avis[0]->descriptionavis }}</p>
                    </div>

                    <div class="buttons">
                        <a class="button" href="/sejour/{{ $sejour->idsejour }}#avis">
                            Voir tous les avis pour ce séjour
                        </a>
                    </div>
                </article>
            @endforeach
        </section>
    </main>
    @include('layout.footer')
@endsection
