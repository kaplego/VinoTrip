@extends('layout.app')
@section('head')
    <link rel="stylesheet" href="/assets/css/welcome.css">
@endsection
@section('title', 'Séjours - VinoTrip')

@section('body')
    @include('layout.header')
    <main class="container-sm">
        <h3>Avis des voyageurs</h3>
        <hr id="ligne">
        <section id="avis">
            @foreach ($listeSejour as $unsejour)
                @php
                    $cpt=0;
                    $total=0;
                    $note=0.0
                @endphp
                @foreach($unsejour->avis as $unavis)
                    @php
                        $total++
                    @endphp
                @endforeach
                @foreach($unsejour->avis as $unavis)
                    @php
                        $cpt++
                    @endphp
                    @if ($cpt==1)
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
                                        class="@if ($note >= 2) checked @endif"></i>
                                    <i data-lucide="star" fill="currentColor"
                                        class="@if ($note >= 3) checked @endif"></i>
                                    <i data-lucide="star" fill="currentColor"
                                        class="@if ($note >= 4) checked @endif"></i>
                                    <i data-lucide="star" fill="currentColor"
                                        class="@if ($note == 5) checked @endif"></i>
                                </p>
                                <p class="valeur">{{ number_format($note, 1, ",") }}/5</p>
                            </div>
                        </div>
                        <article class="unavis">
                            <p><i>{{ $unavis->titreavis }}</i></p>
                            <p>{{ $unavis->descriptionavis }}<p><br/>

                            <div id="divavis">
                                <a class="button" href="/sejour/{{ $unsejour->idsejour }}#avis">voir les {{$total}} avis pour ce séjour</a>
                            </div>
                        </article>
                        <hr class="separateur">
                    @endif
                @endforeach
            @endforeach
            </section>
    </main>
    @include('layout.footer')
@endsection
