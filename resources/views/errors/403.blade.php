@extends('layouts.app')

@section('content')
    <div class="text-center py-5">
        <h1 class="error mx-auto" data-text="403">403</h1>
        <p class="lead">Accès refusé.</p>
        <a href="{{ url('/') }}" class="btn btn-primary">&larr; Retour à l'accueil</a>
    </div>
@endsection
