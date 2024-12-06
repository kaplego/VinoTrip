@extends('layout.app')
@section('head')
    <link rel="stylesheet" href="/assets/css/welcome.css">
@endsection
@section('body')
    @include('layout.header')
    <main class="container-sm">
        <h3>Quelques avis de voyageurs</h3>
        <hr id="ligne">
        <section id="avis">
            @foreach ($listeSejour as $unsejour)
                @php
                    $cpt = 0;
                    $total = 0;
                @endphp
                @foreach ($unsejour->avis as $unavis)
                    @php
                        $total++;
                    @endphp
                @endforeach
                @foreach ($unsejour->avis as $unavis)
                    @php
                        $cpt++;
                    @endphp
                    @if ($cpt == 1)
                        @php
                            $note = 0.0;

                        @endphp
                        <div class="titrenote">
                            <div>
                                <h4>{{ $unsejour->titresejour }}</h4>
                                @foreach ($unsejour->avis as $avis)
                                    @php
                                        $note += $avis->noteavis;
                                    @endphp
                                @endforeach
                                @php
                                    $note = $note / $total;
                                    $note = round($note, 1);
                                @endphp
                            </div>
                            <div class="avis">
                                <p class="note">
                                    <i data-lucide="star" fill="currentColor" class="checked"></i>
                                    <i data-lucide="star" fill="currentColor"
                                        class="@if ($note >= 1.5) checked @endif"></i>
                                    <i data-lucide="star" fill="currentColor"
                                        class="@if ($note >= 2.5) checked @endif"></i>
                                    <i data-lucide="star" fill="currentColor"
                                        class="@if ($note >= 3.5) checked @endif"></i>
                                    <i data-lucide="star" fill="currentColor"
                                        class="@if ($note == 5) checked @endif"></i>
                                </p>
                                <p class="valeur">{{ number_format($note, 1, ",") }}/5</p>
                            </div>
                        </div>
                        </div>
                        <article class="unavis">
                            <p><i>{{ $unavis->titreavis }}</i></p>
                            <p>{{ $unavis->descriptionavis }}
                            <p><br />
                        </article>
                    @endif
                @endforeach
                <hr class="separateur">
            @endforeach
            <div id="divavis">
                <a class="button" href="/avis">Découvrir tout les avis</a>
            </div>
        </section>
    </main>
    @include('layout.footer')
@endsection
