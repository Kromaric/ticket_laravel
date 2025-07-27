<div class="card">
    <form action="{{ route('ticket.store') }}" method="post">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Enter title">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" placeholder="Enter description"></textarea>
            </div>
            <div class="form-group">
                <label for="date">Date</label>
                <input type="date" class="form-control" id="date" name="date" placeholder="Enter date">
            </div>
            <div class="form-group">
                <label for="duree">Duree</label>
                <input type="number" class="form-control" id="duree" name="duree" placeholder="Enter duree">
            </div>
            <div class="form-group">
                <label for="status">Statut</label>
                <select name="status" id="status" class="form-control" required>
                    <option value="ouvert" {{ $ticket->status === 'ouvert' ? 'selected' : '' }}>Ouvert</option>
                    <option value="ferme" {{ $ticket->status === 'ferme' ? 'selected' : '' }}>Fermé</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>


    </form>
</div>
