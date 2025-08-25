@extends('layouts.guest')

@section('content')
    <div class="row g-0">

        {{-- Colonne gauche avec SVG --}}
        <div class="col-lg-5 d-none d-lg-flex align-items-center justify-content-center bg-light">
            <svg xmlns="http://www.w3.org/2000/svg" width="250" height="250" fill="currentColor"
                class="bi bi-person-plus text-primary" viewBox="0 0 16 16">
                <path
                    d="M6 8c1.657 0 3-1.567 3-3.5S7.657 1 6 1 3 2.567 3 4.5 4.343 8 6 8zm0 1c-2.21 0-4 1.343-4 3v1h8v-1c0-1.657-1.79-3-4-3z" />
                <path fill-rule="evenodd"
                    d="M13.5 5.5a.5.5 0 0 1 .5.5V7h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0V8h-1a.5.5 0 0 1 0-1h1V6a.5.5 0 0 1 .5-.5z" />
            </svg>
        </div>

        {{-- Colonne droite avec le formulaire --}}
        <div class="col-lg-7">
            <div class="p-5">
                <div class="text-center mb-4">
                    <h1 class="h4 text-primary ">Créer un compte</h1>
                    <p class="text-muted">Rejoins-nous dès maintenant</p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="user">
                    @csrf

                    {{-- Nom complet + Email --}}
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <input type="text" name="name" class="form-control form-control-user"
                                placeholder="Nom complet" value="{{ old('name') }}" required autofocus>
                            @error('name')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-sm-6">
                            <input type="email" name="email" class="form-control form-control-user"
                                placeholder="Adresse email" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Mot de passe + Confirmation --}}
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <input type="password" name="password" class="form-control form-control-user"
                                placeholder="Mot de passe" required>
                            @error('password')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-sm-6">
                            <input type="password" name="password_confirmation" class="form-control form-control-user"
                                placeholder="Confirmer le mot de passe" required>
                            @error('password_confirmation')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Bouton d’inscription --}}
                    <button type="submit" class="btn btn-primary btn-user btn-block">
                        Créer le compte
                    </button>
                </form>

                <div class="text-center">
                    <a class="small" href="{{ route('password.request') }}">Mot de passe oublié ?</a>
                </div>
                <div class="text-center">
                    <a class="small" href="{{ route('login') }}">Déjà inscrit ? Connecte-toi</a>
                </div>
            </div>
        </div>
    </div>
@endsection
