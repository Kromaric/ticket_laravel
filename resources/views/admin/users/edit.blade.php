@extends('layouts.app')

@section('content')
    <h1>Edit User</h1>

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}" required>
        </div>

        <div class="form-group">
            <label for="role">Role</label>
            <select name="role" id="role" class="form-control" required>
                <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
            </select>
        </div>
        <div class="form-group">
            <label for="taux_horaire">Taux horaire</label>
            <input type="number" name="taux_horaire" id="taux_horaire" class="form-control" value="{{ $user->taux_horaire }}">
        </div>

        <button type="submit" class="btn btn-primary">Update User</button>
    </form>
@endsection
