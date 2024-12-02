@extends('layout.app')

@section('body')
    @include('layout.header')
    <main class="container-sm">
        <h1>Politique de confidentialité</h1>
        <nav id="titre">
            <hr />
        </nav>

        <form method="post" action="/compte">
            Email
            <input type="text" id="email" name="email">
            Mot de passe
            <input type="text" id="password" name="password">

            <button type="submit">Connexion</button>
        </form>
    </main>
    @include('layout.footer')
@endsection
