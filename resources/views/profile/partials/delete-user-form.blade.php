<!-- Bouton déclencheur -->
<button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">
    <i class="fas fa-user-slash me-1"></i> Supprimer mon compte
</button>

<!-- Modal de confirmation -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="false">
  <div class="modal-dialog">
    <form method="POST" action="{{ route('profile.destroy') }}" class="modal-content">
        @csrf
        @method('DELETE')

        <div class="modal-header">
            <h5 class="modal-title text-danger" id="confirmDeleteModalLabel">Confirmer la suppression</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
        </div>

        <div class="modal-body">
            <p>Une fois votre compte supprimé, toutes vos données seront définitivement effacées.</p>
            <p>Veuillez saisir votre mot de passe pour confirmer la suppression.</p>

            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" name="password" id="dell-password" class="form-control" placeholder="Mot de passe" required>
                @error('password', 'userDeletion')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
            <button type="submit" class="btn btn-danger">Supprimer</button>
        </div>
    </form>
  </div>
</div>
