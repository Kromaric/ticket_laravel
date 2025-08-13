@extends('layouts.app')

@section('content')
    <!--Ticket DataTales -->
    <div class="card shadow mb-4">
        <div class="card-header pt-3">
            <div class="row">
                <div class="col">
                    <h5 class="font-weight-bold text-primary float-left">Liste des Utilisateurs</h5>
                </div>
                <div class="col">
                    <a href="{{ route('admin.users.create') }}" class="btn btn-primary float-right">Add New</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Nom</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Taux horaire</th>
                                <th>Nombre de tickets</th>
                                <th>Salaire total (€)</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->role }}</td>
                                    <td>{{ $user->taux_horaire }}</td>
                                    <td><a href="{{ route('admin.users.tickets', $user->id) }}" style="text-decoration: none;">{{ $user->tickets_count }}</a></td>
                                    <td>{{ number_format($user->salaire(), 2, ',', ' ') }}</td>
                                    <td>
                                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-primary"><i
                                                class="fas fa-edit"></i></a>
                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
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
