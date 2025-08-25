@extends('layouts.guest')

@section('content')
    <div class="row justify-content-center">

        <!-- Colonne SVG -->
        <div class="col-lg-5 d-none d-lg-flex align-items-center justify-content-center bg-light">
            <svg xmlns="http://www.w3.org/2000/svg" width="200" height="200" fill="currentColor"
                 class="bi bi-envelope-check text-primary" viewBox="0 0 16 16">
                <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95
                         1.555L8 8.414.05 3.555z"/>
                <path d="M0 4.697v7.104l5.803-3.551L0 4.697z"/>
                <path d="M6.761 8.83L0 12.803V4.697l6.761 4.133z"/>
                <path d="M8 9.586l8-5.03v7.104l-8-4.074z"/>
                <path d="M16 4.697v7.104l-6.761-4.07L16 4.697z"/>
                <path fill-rule="evenodd" d="M15.854 11.146a.5.5 0 0 0-.708 0l-3
                         3-1.646-1.647a.5.5 0 1 0-.708.708l2
                         2a.5.5 0 0 0 .708 0l3.646-3.647a.5.5 0 0 0 0-.708z"/>
            </svg>
        </div>

        <div class="col-lg-7">
            <div class="p-5">
                <div class="text-center mb-4">
                    <h2 class="h4 text-primary">Vérification de l’adresse email</h2>
                    <p class="text-muted">
                        Merci pour ton inscription ! Avant de commencer, vérifie ton adresse email en cliquant sur le lien que nous venons de t’envoyer. Si tu ne l’as pas reçu, tu peux demander un nouvel envoi.
                    </p>
                    </div>

                    {{-- Message de confirmation --}}
                    @if (session('status') == 'verification-link-sent')
                        <div class="alert alert-success">
                            Un nouveau lien de vérification a été envoyé à l’adresse email fournie lors de l’inscription.
                        </div>
                    @endif

                    <div class="d-grid mb-3">
                        {{-- Formulaire pour renvoyer le lien --}}
                        <form method="POST" action="{{ route('verification.send') }}">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                Renvoyer l’email de vérification
                            </button>
                        </form>
                    </div>

                    <div class="text-center">
                        {{-- Déconnexion --}}
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-link text-decoration-none text-muted">
                                Se déconnecter
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
