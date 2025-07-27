@extends('layouts.app')

@section('content')
    <h1>Paie des utilisateurs</h1>
    <table border="1" cellpadding="8">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Email</th>
                <th>Taux horaire</th>
                <th>Nombre de tickets</th>
                <th>Salaire total (€)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->taux_horaire }}</td>
                    <td>{{ $user->tickets->count() }}</td>
                    <td>{{ number_format($user->salaire(), 2, ',', ' ') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
