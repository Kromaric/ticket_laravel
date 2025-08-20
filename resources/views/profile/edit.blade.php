@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 text-dark">Mon profil</h1>
            <a href="{{ route('dashboard') }}" class="btn btn-outline-primary btn-sm">
                <i class="fas fa-arrow-left"></i> Retour
            </a>
        </div>

        {{-- Profil --}}
        <div class="card mb-4">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <img src="{{ $user->avatar_url ?? 'https://via.placeholder.com/120' }}"
                        class="rounded-circle border mr-3" width="100" height="100" alt="Avatar">
                    <div>
                        <h4 class="mb-1">{{ $user->name }}</h4>
                        <p class="mb-1 text-muted">{{ $user->email }}</p>
                        <span class="badge badge-{{ $user->role === 'admin' ? 'danger' : 'info' }}">
                            {{ ucfirst($user->role) }}
                        </span>
                        <p class="mt-2 text-muted">
                            <i class="fas fa-calendar-alt mr-1"></i>Inscrit le {{ $user->created_at->format('d/m/Y') }}
                        </p>
                    </div>
                </div>

                <div class="text-right">
                    <p><strong>Tickets total :</strong> {{ $stats['total'] }}</p>
                    <p><strong>Tickets résolus :</strong> {{ $stats['resolved'] }}</p>
                    <p><strong>Tickets en cours :</strong> {{ $stats['encours'] }}</p>
                    <p><strong>Tickets en attente :</strong> {{ $stats['pending'] }}</p>
                    <p><strong>Durée moyenne :</strong> {{ number_format($stats['avgDuration'], 2, ',', ' ') }} h</p>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header bg-white">
                <h5 class="mb-0">Modifier mes informations</h5>
            </div>
            <div class="card-body">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header bg-white">
                <h5 class="mb-0">Changer mon mot de passe</h5>
            </div>
            <div class="card-body">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header bg-white">
                <h5 class="mb-0 text-danger">Supprimer mon compte</h5>
            </div>
            <div class="card-body">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
@endsection
