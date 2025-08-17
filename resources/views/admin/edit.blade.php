@extends('layouts.app')
@section('content')
    <h1>Modifier ticket</h1>

    <form action="{{ route('admin.tickets.update', $ticket->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Titre</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ $ticket->title }}" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control" required>{{ $ticket->description }}</textarea>
        </div>

        <div class="form-group">
            <label for="date">Date</label>
            <input type="date" name="date" id="date" class="form-control" value="{{ $ticket->date }}" required>
        </div>

        <div class="form-group">
            <label for="duree">Durée (en heures)</label>
            <input type="number" name="duree" id="duree" class="form-control" value="{{ $ticket->duree }}" required>
        </div>

        <div class="form-group">
            <label for="status">Statut</label>
            <select name="status" id="status" class="form-control" required>
                <option value="pending" {{ $ticket->status === 'pending' ? 'selected' : '' }}>En attente</option>
                <option value="ouvert" {{ $ticket->status === 'ouvert' ? 'selected' : '' }}>Ouvert</option>
                <option value="ferme" {{ $ticket->status === 'ferme' ? 'selected' : '' }}>Fermé</option>
            </select>
        </div>

        <div class="form-group">
            <label for="user_id">Utilisateur</label>
            <select name="user_id" id="user_id" class="form-control" required>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ $ticket->user_id === $user->id ? 'selected' : '' }}>
                        {{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour le ticket</button>
    </form>
@endsection
