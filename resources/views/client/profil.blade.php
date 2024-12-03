@extends('layout.app')

@section('body')
    @include('layout.header')
    <main class="container-sm">
        <form method="post" action="/api/client/logout">
            @csrf
            <button type="submit">
                Deconnexion
            </button>
        </form>
    </main>
    @include('layout.footer')
@endsection
