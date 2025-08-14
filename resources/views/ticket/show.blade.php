@extends('layouts.app')

@section('content')
    <div class="card shadow-sm border-left-primary mb-4">
        <div class="card-header bg-white py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="font-weight-bold text-primary mb-0">
                    <i class="fas fa-ticket-alt mr-2"></i>{{ $ticket->title }}
                </h5>
                <a href="{{ route('ticket.edit', $ticket) }}" class="btn btn-sm btn-outline-primary">
                    <i class="fas fa-edit mr-1"></i>Modifier
                </a>
            </div>
        </div>

        <div class="card-body text-dark">
            <div class="row mb-3">
                <div class="col-12">
                    <p>
                        <i class="fas fa-align-left text-secondary mr-2"></i>
                        <strong>Description :</strong> {{ $ticket->description }}
                    </p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <p>
                        <i class="fas fa-calendar-alt text-secondary mr-2"></i>
                        <strong>Date :</strong> {{ \Carbon\Carbon::parse($ticket->date)->format('d/m/Y') }}
                    </p>
                    <p>
                        <i class="fas fa-clock text-secondary mr-2"></i>
                        <strong>Durée :</strong> {{ $ticket->duree }} heures
                    </p>
                    <p>
                        <i class="fas fa-euro-sign text-secondary mr-2"></i>
                        <strong>Coût :</strong> {{ number_format($ticket->montant, 2, ',', ' ') }} €
                    </p>
                </div>

                <div class="col-md-6 mb-3">
                    <p>
                        <i class="fas fa-info-circle text-secondary mr-2"></i>
                        <strong>Status :</strong>
                        <span class="badge badge-pill badge-{{ $ticket->status === 'Résolu' ? 'success' : 'warning' }}">
                            {{ $ticket->status }}
                        </span>
                    </p>
                    <p>
                        <i class="fas fa-user text-secondary mr-2"></i>
                        <strong>Ressource :</strong> {{ $ticket->user->name }}
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
