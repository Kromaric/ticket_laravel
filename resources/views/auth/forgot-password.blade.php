@extends('layouts.guest')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-5 d-none d-lg-flex align-items-center justify-content-center bg-light">
            <svg xmlns="http://www.w3.org/2000/svg" width="200" height="200" fill="currentColor"
                class="bi bi-lock text-primary" viewBox="0 0 16 16">
                <path d="M8 1a3 3 0 0 0-3 3v3H4a2 2 0 0 0-2
                                 2v5a2 2 0 0 0 2 2h8a2 2 0 0
                                 0 2-2v-5a2 2 0 0 0-2-2h-1V4a3
                                 3 0 0 0-3-3zm-2 6V4a2 2 0 1 1
                                 4 0v3H6z" />
            </svg>
        </div>

        <div class="col-lg-7">
            <div class="p-5">
                <div class="text-center mb-4">
                    <h2 class="h4 text-primary">Mot de passe oublié ?</h2>
                    <p class="text-muted">
                        Pas de souci. Indique ton adresse email et nous t’enverrons un lien pour réinitialiser ton
                        mot de passe.
                    </p>
                </div>

                {{-- Message de session --}}
                @if (session('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
                @endif

                {{-- Formulaire --}}
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="form-group mb-3">
                        <label for="email" class="form-label">Adresse email</label>
                        <input type="email" name="email" id="email" class="form-control form-control-user"
                            value="{{ old('email') }}" required autofocus>
                        @error('email')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>


                    <button type="submit" class="btn btn-primary btn-user btn-block">
                        Réinitialiser le mot de passe
                    </button>

                </form>

                <hr class="my-4">

                <div class="text-center">
                    <a href="{{ route('login') }}" class="small text-decoration-none">
                        Retour à la connexion
                    </a>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
