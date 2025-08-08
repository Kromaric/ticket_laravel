@extends('layouts.app')

@section('content')
<!--Ticket DataTales -->
    <div class="card shadow mb-4">
        <div class="card-header pt-3">
            <div class="row">
                <div class="col">
                    <h5 class="font-weight-bold text-primary float-left">Liste des tickets  {{ $pageTitle }}</h5>
                </div>
                <div class="col">
                    <a href="{{ route('ticket.create') }}" class="btn btn-primary float-right">Add New</a>
                </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Ressource</th>
                            <th>Titre</th>
                            <th>Description</th>
                            <th>Date</th>
                            <th>Durée</th>
                            <th>Salaire</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                         @foreach ($tickets as $ticket)
                            <tr>
                                <td>{{ $ticket->id }}</td>
                                <td style="max-width: 100px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                    {{ $ticket->user->name }}
                                </td>
                                <td style="max-width: 150px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                    <a href="{{ route('ticket.show', $ticket) }}" style="text-decoration: none;">
                                        {{ $ticket->title}}
                                    </a>
                                </td>
                                <td style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                    {{ $ticket->description}}
                                </td>
                                <td>{{ $ticket->date->format('d M Y') }}</td>
                                <td >{{ $ticket->duree }}</td>
                                <td>{{ $ticket->montant }}</td>
                                <td>{{ $ticket->status }}</td>
                                <td>
                                    <a href="{{ route('ticket.edit', $ticket) }}" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                    <!-- Form for deleting a ticket -->
                                    <form action="{{ route('ticket.destroy', $ticket) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
