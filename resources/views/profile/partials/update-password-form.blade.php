<div class="card mb-4">
    <div class="card-header bg-white">
        <h5 class="mb-0">Changer mon mot de passe</h5>
        <small class="text-muted">Utilisez un mot de passe long et aléatoire pour renforcer la sécurité de votre compte.</small>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="current_password" class="form-label">Mot de passe actuel</label>
                <input type="password" name="current_password" id="current_password" class="form-control" autocomplete="current-password">
                @error('current_password', 'updatePassword')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Nouveau mot de passe</label>
                <input type="password" name="password" id="password" class="form-control" autocomplete="new-password">
                @error('password', 'updatePassword')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirmer le mot de passe</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" autocomplete="new-password">
                @error('password_confirmation', 'updatePassword')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex align-items-center">
                <button type="submit" class="btn btn-primary me-3">Enregistrer</button>

                @if (session('status') === 'password-updated')
                    <span class="text-success small">Mot de passe mis à jour avec succès.</span>
                @endif
            </div>
        </form>
    </div>
</div>
