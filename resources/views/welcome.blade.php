@extends('layout.app')

@section('title', 'VinoTrip')

@section('head')
    <link rel="stylesheet" href="/assets/css/welcome.css">
@endsection

@section('body')
    @include('layout.header')
    <main class="container-sm">
        <h1>Quelques avis de voyageurs</h1>
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
                    <a class="titre-avis" href="{{ route('sejour', ['idsejour' => $sejour->idsejour]) }}">{{ $sejour->titresejour }}</a>
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
                </article>
            @endforeach
            <div class="buttons">
                <a class="button" href="{{ route('avis') }}">Découvrir tout les avis</a>
            </div>
        </section>
    </main>
    @include('layout.footer')
@endsection
