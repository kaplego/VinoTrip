@extends('layout.app')

@section('body')
    @include('layout.header')
    <main class="container-sm">
        <h1>Politique de confidentialité</h1>
        <hr class="separateur-titre" />

        <form method="post" action="/authenticate">
            @csrf
            Email
            <input type="text" name="emailclient"/>
            Mot de passe
            <input type="password" name="motdepasseclient"/>
            <input type="submit" value="connexion"/>

            {{ $errors }}
        </form>
    </main>
    @include('layout.footer')
@endsection
