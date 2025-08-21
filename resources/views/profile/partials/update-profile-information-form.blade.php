<div class="card mb-4">
    <div class="card-header bg-white">
        <h5 class="mb-0">Informations du profil</h5>
        <small class="text-muted">Modifiez votre nom et votre adresse email.</small>
    </div>

    <div class="card-body">
        {{-- Formulaire de renvoi de vérification --}}
        <form id="send-verification" method="POST" action="{{ route('verification.send') }}">
            @csrf
        </form>

        {{-- Formulaire principal --}}
        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="mb-3">
                <label for="name" class="form-label">Nom</label>
                <input type="text" name="name" id="name" class="form-control"
                    value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
                @error('name')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Adresse email</label>
                <input type="email" name="email" id="email" class="form-control"
                    value="{{ old('email', $user->email) }}" required autocomplete="username">
                @error('email')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                    <div class="mt-2">
                        <p class="text-muted small">
                            Votre adresse email n’est pas vérifiée.
                            <button form="send-verification" class="btn btn-link btn-sm p-0 align-baseline">
                                Cliquez ici pour renvoyer l’email de vérification.
                            </button>
                        </p>

                        @if (session('status') === 'verification-link-sent')
                            <div class="text-success small">
                                Un nouveau lien de vérification a été envoyé à votre adresse email.
                            </div>
                        @endif
                    </div>
                @endif
            </div>
            <div class="mb-4">
                <label for="avatar" class="form-label fw-bold">Photo de profil</label>
                <input type="file" name="avatar" id="avatar" class="form-control" accept="image/*">

                @error('avatar')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror

                @if ($user->avatar_url)
                    <div class="mt-3 d-flex align-items-center">
                        <img src="{{ $user->avatar_url }}" alt="Avatar actuel" class="img-thumbnail me-3"
                            style="max-width: 120px;">
                        <span class="text-muted small">Avatar actuel</span>
                    </div>
                @endif
            </div>
            <div class="d-flex align-items-center">
                <button type="submit" class="btn btn-primary me-3">Enregistrer</button>

                @if (session('status') === 'profile-updated')
                    <span class="text-success small">Profil mis à jour avec succès.</span>
                @endif
            </div>
        </form>
    </div>
</div>
