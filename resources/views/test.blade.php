@extends('layout.app')

@section('body')
    <main>
        {{Cookie::get('dialogflow_session')}}
    </main>
@endsection
