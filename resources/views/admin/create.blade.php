@extends('layouts.app')

@section('content')
    <h1>Créer un nouveau ticket</h1>

    <form action="{{ route('admin.tickets.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="title">Titre</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control" required></textarea>
        </div>

        <div class="form-group">
            <label for="date">Date</label>
            <input type="date" name="date" id="date" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="duree">Durée</label>
            <input type="text" name="duree" id="duree" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="montant">Montant</label>
            <input type="text" name="montant" id="montant" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="status">Statut</label>
            <select name="status" id="status" class="form-control" required>
                <option value="pending">En attente</option>
                <option value="ouvert">Ouvert</option>
                <option value="ferme">Fermé</option>
            </select>
        </div>

        <div class="form-group">
            <label for="user_id">Ressource</label>
            <select name="user_id" id="user_id" class="form-control" required>
                @foreach ($users as $user)
                    < <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Créer</button>
    </form>
@endsection
