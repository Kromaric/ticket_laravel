@extends('layouts.app')


@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>

    <!-- Content Row -->
    @include('partials.stats')


    <!--Ticket DataTales -->
    <div class="card shadow mb-4">
        <div class="card-header pt-3">
            <div class="row">
                <div class="col">
                    <h5 class="font-weight-bold text-primary float-left">Mes tickets</h5>
                </div>
                <div class="col">
                    <a href="{{ route('ticket.create') }}" class="btn btn-sm btn-primary float-right"><i
                            class="fas fa-plus mr-1"></i>Add New</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>N°</th>
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
                                <td
                                    style="max-width: 150px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                    <a href="{{ route('ticket.show', $ticket) }}"
                                        style="text-decoration: none;">{{ $ticket->title }}</a>
                                </td>
                                <td
                                    style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                    {{ $ticket->description }}</td>
                                <td>{{ $ticket->date->format('d M Y') }}</td>
                                <td>{{ $ticket->duree }}</td>
                                <td>{{ $ticket->montant }}</td>
                                <td>{{ $ticket->status }}</td>
                                <td>
                                    <a href="{{ route('ticket.edit', $ticket) }}" class="btn btn-outline-primary"><i
                                            class="fas fa-edit"></i></a>
                                    <!-- Form for deleting a ticket -->
                                    <form action="{{ route('ticket.destroy', $ticket) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger"><i
                                                class="fas fa-trash"></i></button>
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
