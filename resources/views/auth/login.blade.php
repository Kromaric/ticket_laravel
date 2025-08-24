@extends('layouts.guest')

@section('content')
    <!-- Nested Row within Card Body -->
    <div class="row">
        {{-- Colonne gauche avec SVG --}}
        <div class="col-lg-6 d-none d-lg-flex align-items-center justify-content-center bg-light">
            <svg xmlns="http://www.w3.org/2000/svg" width="200" height="200" fill="currentColor"
                class="bi bi-shield-lock text-primary" viewBox="0 0 16 16">
                <path d="M5.5 9a1.5 1.5 0 0 1 3 0V11a1.5 1.5 0 0 1-3 0V9z" />
                <path
                    d="M7.467.133a1 1 0 0 1 1.066 0l6 3.6A1 1 0 0 1 15 4.6V9c0 5.25-3.5 7.5-7 7.5S1 14.25 1 9V4.6a1 1 0 0 1 .467-.867l6-3.6zM8 1.067 2 4.2V9c0 4.5 2.9 6.5 6 6.5s6-2 6-6.5V4.2L8 1.067z" />
            </svg>
        </div>

        {{-- Colonne droite avec le formulaire --}}
        <div class="col-lg-6">
            <div class="p-5">
                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Bienvenue !</h1>
                </div>

                <form method="POST" action="{{ route('login') }}" class="user">
                    @csrf

                    {{-- Email --}}
                    <div class="form-group">
                        <input type="email" name="email" class="form-control form-control-user" id="email"
                            placeholder="Adresse email..." value="{{ old('email') }}" required autofocus>
                        @error('email')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div class="form-group">
                        <input type="password" name="password" class="form-control form-control-user" id="password"
                            placeholder="Mot de passe" required>
                        @error('password')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Remember Me --}}
                    <div class="form-group">
                        <div class="custom-control custom-checkbox small">
                            <input type="checkbox" class="custom-control-input" id="remember" name="remember">
                            <label class="custom-control-label" for="remember">Se souvenir de moi</label>
                        </div>
                    </div>

                    {{-- Bouton --}}
                    <button type="submit" class="btn btn-primary btn-user btn-block">
                        Connexion
                    </button>
                </form>

                <hr>
                @if (Route::has('password.request'))
                    <div class="text-center">
                        <a class="small" href="{{ route('password.request') }}">Mot de passe oublié ?</a>
                    </div>
                @endif
                @if (Route::has('register'))
                    <div class="text-center">
                        <a class="small" href="{{ route('register') }}">Créer un compte !</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
