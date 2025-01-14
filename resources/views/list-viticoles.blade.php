@extends('layout.app')

@section('title', 'Les viticoles - VinoTrip')

@section('head')
    <link rel="stylesheet" href="/assets/css/client/commandes.css">
@endsection

@section('body')
    @include('layout.header')
    <main class="container-sm">
        @include('layout.breadcrumb')

        <h1>Les viticoles</h1>
        <hr class="separateur-titre" />

        <table class="liste">
            <thead>
                <tr>
                    <th scope="col">Nom viticole</th>
                    <th scope="col">Nombre de séjours</th>

                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($viticoles as $viticole)
                <tr>
                    <td>{{ $viticole->libellecategorievignoble }}</td>
                    <td>{{ $viticole->Sejour()->count() }}</td>
                    <td>
                        <form action="/api/viticoles/{{$viticole->idcategorievignoble}}/delete" method="POST">
                            @csrf
                            <button type="submit" @if($viticole->Sejour()->count() != 0)disabled title="La catégorie doit avoir aucun séjour pour la supprimer" @endif >Supprimer</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        </br>
        <h2>Ajouter un viticole</h2>


        <form action="/api/viticoles/add" method="POST">
            @csrf
            <label for="libellecategorievignbole">Nom viticole</label>
            <input type="text" name="libellecategorievignbole" id="libellecategorievignbole">

            <button type="submit">Ajouter</button>
        </form>
    </main>
    @include('layout.footer')
@endsection
