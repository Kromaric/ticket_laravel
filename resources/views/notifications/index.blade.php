@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Mes notifications</h2>
    <form action="{{ route('notifications.markAllRead') }}" method="POST" class="mb-3">
        @csrf
        <button class="btn btn-sm btn-outline-primary">Tout marquer comme lu</button>
    </form>
    @forelse($notifications as $notification)
        @php
            $type = $notification->data['type'] ?? 'info';
            $icon = match($type) {
                'created' => 'fa-plus',
                'resolved' => 'fa-check',
                'updated' => 'fa-edit',
                'welcome' => 'fa-user',
                default => 'fa-info',
            };
            $bgColor = match($type) {
                'created' => 'primary',
                'resolved' => 'success',
                'updated' => 'warning',
                'welcome' => 'info',
                default => 'secondary',
            };
        @endphp

        <div class="alert alert-{{ $bgColor }} d-flex justify-content-between align-items-center">
            <div>
                <i class="fas {{ $icon }} mr-2"></i>
                <strong>{{ $notification->data['title'] ?? 'Notification' }}</strong><br>
                {{ $notification->data['message'] ?? '...' }}
                <div class="small text-muted">{{ $notification->created_at->diffForHumans() }}</div>
            </div>
            @if(isset($notification->data['ticket_id']))
                <a href="{{ url('/tickets/' . $notification->data['ticket_id']) }}" class="btn btn-sm btn-outline-light">Voir</a>
            @endif
        </div>
    @empty
        <div class="alert alert-info">Aucune notification pour le moment.</div>
    @endforelse

    <div class="d-flex justify-content-center mt-4">
        {{ $notifications->links() }}
    </div>
</div>
@endsection
