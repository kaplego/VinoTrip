@php
    $active = 'compte';
@endphp

@section('title', 'Informations - Mon Compte - VinoTrip')

@extends('layout.app')

@section('head')
    <link rel="stylesheet" href="/assets/css/client/securite.css">
@endsection

@section('body')
    @include('layout.header')
    <main class="container-sm">
        @php
            $bcCustomLink = 'client/sécurité';
        @endphp
        @include('layout.breadcrumb')
        <h1>Sécurité</h1>
        <hr class="separateur-titre" />
        @if (\Session::has('success'))
            <p class="alert alert-success"><i data-lucide="circle-check-big"></i>{!! \Session::get('success') !!}</p>
        @endif
        <div id="a2f">
            <h2>Authentification à deux facteurs</h2>
            <p>L'authentification à deux facteurs permet d'ajouter une étape de sécurité. Le système vous
                demandera un
                code de vérification par SMS avant de vous connecter.</p>
            <div class="alert alert-success hidden" id="a2f-complete">
                <i data-lucide="circle-check-big"></i>
                <span class="text">L'A2F a bien été modifiée.</span>
            </div>
            <form class="formulaire" id="a2f-form">
                @csrf
                <div class="input-control input-control-text">
                    <label>Numéro de téléphone</label>
                    <input type="text" value="+33 {{ substr(Auth::user()->telephoneclient, 1, 1) }} {{ implode(' ', str_split(substr(Auth::user()->telephoneclient, 2), 2)) }}" readonly />
                    <a href="{{ route('client.infos') }}" class="link" style="width: max-content;">Modifier mon numéro de
                        téléphone</a>
                    @error('phone')
                        <div class="alert alert-error"><i data-lucide="circle-x"></i>{{ $message }}</div>
                    @enderror
                </div>
                <div class="input-control input-control-text hidden" id="a2f-code">
                    <label>Code de vérification</label>
                    <input type="text" name="code" placeholder="XXXXXX" autocomplete="off" />
                    <div class="alert alert-error hidden" id="a2f-code-error"><i data-lucide="circle-x"></i><span
                            class="text"></span></div>
                </div>
                <button type="submit" class="button" id="button-submit" disabled>
                    @if (Auth::user()->a2f)
                        Désactiver l'A2F
                    @else
                        Activer l'A2F
                    @endif
                </button>
                <button class="button hidden" id="button-cancel" type="button" disabled>Annuler</button>
            </form>
        </div>
    </main>
    @include('layout.footer')
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="/assets/js/client/securite.js" type="module"></script>
@endsection
