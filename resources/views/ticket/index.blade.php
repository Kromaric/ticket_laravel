@extends('layouts.app')


@section('content')
<h1>Bienvenue sur la page des tickets</h1>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Liste des tickets</h2>
            <a href="{{ route('ticket.create') }}" class="btn btn-primary mb-3">Créer un nouveau ticket</a>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Titre</th>
                        <th>Description</th>
                        <th>Date</th>
                        <th>Durée</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tickets as $ticket)
                        <tr>
                            <td>{{ $ticket->title }}</td>
                            <td>{{ $ticket->description }}</td>
                            <td>{{ $ticket->date }}</td>
                            <td>{{ $ticket->duree }}</td>
                            <td>
                                <a href="{{ route('ticket.edit', $ticket) }}" class="btn btn-warning">Modifier</a>
                                <!-- Form for deleting a ticket -->
                                <form action="{{ route('ticket.destroy', $ticket) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection


