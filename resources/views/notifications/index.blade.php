@extends('layouts.app')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header pt-3">
            <div class="row">
                <div class="col">
                    <h5 class="font-weight-bold text-primary float-left">Mes notifications</h5>
                </div>
                <div class="col">
                    <form action="{{ route('notifications.markAllRead') }}" method="POST" class="float-right">
                        @csrf
                        <button class="btn btn-sm btn-outline-primary">Tout marquer comme lu</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Type</th>
                            <th>Titre</th>
                            <th>Message</th>
                            <th>Date</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($notifications as $notification)
                            @php
                                $type = $notification->data['type'] ?? 'info';
                                $icon = match ($type) {
                                    'created' => 'fa-plus',
                                    'resolved' => 'fa-check',
                                    'updated' => 'fa-edit',
                                    'welcome' => 'fa-user',
                                    default => 'fa-info',
                                };
                                $bgColor = match ($type) {
                                    'created' => 'primary',
                                    'resolved' => 'success',
                                    'updated' => 'warning',
                                    'welcome' => 'info',
                                    default => 'secondary',
                                };
                            @endphp
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><i class="fas {{ $icon }} text-{{ $bgColor }}"></i> {{ $type }}
                                </td>
                                <td>{{ $notification->data['title'] ?? 'Notification' }}</td>
                                <td>{{ $notification->data['message'] ?? '...' }}</td>
                                <td>{{ $notification->created_at->format('d M Y H:i') }}</td>
                                <td>
                                    @if ($notification->read_at)
                                        <span class="badge badge-success">Lu</span>
                                    @else
                                        <span class="badge badge-warning">Non lu</span>
                                    @endif
                                </td>
                                <td>
                                    @if (isset($notification->data['ticket_id']))
                                        <a href="{{ url('/ticket/' . $notification->data['ticket_id']) }}"
                                            class="btn btn-sm btn-outline-info">Voir</a>
                                    @endif
                                    <form action="{{ route('notifications.markRead', $notification) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        <button class="btn btn-sm btn-outline-success" title="Marquer comme lu"><i
                                                class="fas fa-check"></i></button>
                                    </form>
                                    <form action="{{ route('notifications.destroy', $notification) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger" title="Supprimer"><i
                                                class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Aucune notification pour le moment.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
