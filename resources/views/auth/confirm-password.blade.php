@extends('layouts.guest')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-5 d-none d-lg-flex align-items-center justify-content-center bg-light">
            <svg xmlns="http://www.w3.org/2000/svg" width="200" height="200" fill="currentColor"
                class="bi bi-shield-lock text-primary" viewBox="0 0 16 16">
                <path d="M5.5 9a1.5 1.5 0 0 1 3 0v1h-3V9z" />
                <path d="M7.5 0a.5.5 0 0 1 .5.5v1.021c.228.015.454.05.676.105l.708-.707A.5.5
                    0 0 1 10 1.207l-.646.647a5.477 5.477 0 0 1
                    1.236 1.236l.647-.646a.5.5 0 0 1
                    .708.708l-.707.708c.055.222.09.448.105.676H15a.5.5
                    0 0 1 .5.5V7c0 5.064-3.582 9.429-8.5 10A9.978
                    9.978 0 0 1 1 7V2.5a.5.5 0 0 1 .5-.5h4.5V.5a.5.5
                    0 0 1 .5-.5z" />
            </svg>
        </div>

        <div class="col-lg-7">
            <div class="p-5">
                <div class="text-center mb-4">
                    <h2 class="h4 text-primary">Confirmation requise</h2>
                    <p class="text-muted">
                        Cette zone est sécurisée. Veuillez confirmer votre mot de passe pour continuer.
                    </p>
                </div>

                {{-- Formulaire --}}
                <form method="POST" action="{{ route('password.confirm') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="password" class="form-label">Mot de passe</label>
                        <input type="password" name="password" id="password" class="form-control form-control-user"
                            required autocomplete="current-password">
                        @error('password')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-user btn-block">
                            Confirmer
                        </button>
                    </div>
                </form>

                <hr class="my-4">

                <div class="text-center">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="small text-decoration-none">
                            Mot de passe oublié ?
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
