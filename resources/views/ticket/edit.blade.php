@extends('layouts.app')
@section('content')
<h1>Modifier le ticket</h1>
<div class="container">

    <div class="card">
        <form action="{{ route('ticket.update', $ticket) }}" method="post">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group">
                    <label for="title">Titre</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ $ticket->title }}" placeholder="Entrez le titre">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description" placeholder="Entrez la description">{{ $ticket->description }}</textarea>
                </div>
                <div class="form-group">
                    <label for="date">Date</label>
                    <input type="date" class="form-control" id="date" name="date" value="{{ $ticket->date }}" placeholder="Entrez la date">
                </div>
                <div class="form-group">
                    <label for="duree">Duree</label>
                    <input type="number" class="form-control" id="duree" name="duree" value="{{ $ticket->duree }}" placeholder="Entrez la duree">
                </div>
                <button type="submit" class="btn btn-primary">Modifier</button>
            </div>
        </form>
    </div>
</div>
@endsection
