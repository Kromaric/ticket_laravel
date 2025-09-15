@extends('layouts.app')

@section('content')
    <div class="text-center py-5">
        <h1 class="error mx-auto" data-text="404">404</h1>
        <p class="lead">La page que vous cherchez n'existe pas.</p>
        <a href="{{ url('/') }}" class="btn btn-primary">&larr; Retour à l'accueil</a>
    </div>
@endsection
