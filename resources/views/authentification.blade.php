@extends('layout.app')

@section('body')
    @include('layout.header')
    <main class="container-sm">
        <h1>Politique de confidentialité</h1>
        <nav id="titre">
            <hr />
        </nav>

        <form method="post" action="/compte">
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
