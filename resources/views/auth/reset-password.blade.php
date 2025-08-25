@extends('layouts.guest')

@section('content')
    <div class="row justify-content-center">

        <!-- Colonne SVG -->
        <div class="col-lg-5 d-none d-lg-flex align-items-center justify-content-center bg-light">
            <svg xmlns="http://www.w3.org/2000/svg" width="200" height="200" fill="currentColor"
                 class="bi bi-key text-primary" viewBox="0 0 16 16">
                <path d="M3 8a5 5 0 1 1 9.9 1h.6a.5.5 0 0 1 .354.854l-1.5 1.5a.5.5
                         0 0 1-.708 0L11 10.707l-.793.793a.5.5 0 0 1-.708 0L8.5
                         10.5l-1 1V13h-.5a.5.5 0 0 1-.5-.5V11h-2A5 5 0 0 1 3 8z"/>
            </svg>
        </div>

        <div class="col-lg-7">
            <div class="p-5">
                <div class="text-center mb-4">
                    <h2 class="h4 text-primary">Réinitialiser le mot de passe</h2>
                    <p class="text-muted">Entre ton nouveau mot de passe ci-dessous</p>
                </div>

                    {{-- Formulaire --}}
                    <form method="POST" action="{{ route('password.store') }}">
                        @csrf

                        {{-- Jeton de réinitialisation --}}
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">

                        {{-- Email --}}
                        <div class="mb-3">
                            <input type="email" name="email" id="email"
                                   class="form-control form-control-user"
                                   placeholder="Adresse email"
                                   value="{{ old('email', $request->email) }}" required autofocus autocomplete="username">
                            @error('email')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Nouveau mot de passe --}}
                        <div class="mb-3">
                            <input type="password" name="password" id="password"
                                   class="form-control form-control-user"
                                   placeholder="Nouveau mot de passe"
                                   required autocomplete="new-password">
                            @error('password')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Confirmation mot de passe --}}
                        <div class="mb-3">
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                   class="form-control form-control-user"
                                   placeholder="Confirmer le mot de passe"
                                   required autocomplete="new-password">
                            @error('password_confirmation')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Bouton --}}
                        <button type="submit" class="btn btn-primary btn-user btn-block">
                            Réinitialiser le mot de passe
                        </button>
                    </form>

                    <hr class="my-4">

                    <div class="text-center">
                        <a href="{{ route('login') }}" class="small text-decoration-none">Retour à la connexion</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
