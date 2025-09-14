@extends('layouts.app')

@section('content')
    <h1>Logs d'activité</h1>

    {{-- Filtres --}}
    <form method="GET" class="mb-4 d-flex gap-3 flex-wrap">
        <input type="text" name="q" value="{{ $query }}" placeholder="Rechercher..." class="form-control" />

        <select name="level" class="form-select">
            <option value="">Tous niveaux</option>
            <option value="info" {{ strtolower($level) == 'info' ? 'selected' : '' }}>Info</option>
            <option value="warning" {{ strtolower($level) == 'warning' ? 'selected' : '' }}>Warning</option>
            <option value="error" {{ strtolower($level) == 'error' ? 'selected' : '' }}>Error</option>
        </select>

        <button type="submit" class="btn btn-primary">Filtrer</button>
        <a href="{{ route('admin.logs.index') }}" class="btn btn-outline-secondary">Réinitialiser</a>
    </form>

    {{-- Résumé --}}
    <p class="text-muted">Résultats : {{ $total }}</p>

    {{-- Tableau --}}
    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>Date</th>
                    <th>Événement</th>
                    <th>Niveau</th>
                    <th>Données</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($logs as $log)
                    <tr>
                        <td>{{ $log['date'] }}</td>
                        <td>{{ $log['event'] }}</td>
                        <td>
                            @php
                                $colors = ['info' => 'primary', 'warning' => 'warning', 'error' => 'danger'];
                                $color = $colors[strtolower($log['level'])] ?? 'secondary';
                            @endphp
                            <span class="badge text-{{ $color }}">{{ strtoupper($log['level']) }}</span>
                        </td>
                        <td style="max-width: 300px;">
                            <ul class="mb-0" style="overflow-y: auto; max-height: 150px;">
                                @foreach ($log['data'] as $key => $value)
                                    <li><strong>{{ $key }}:</strong> {{ $value }}</li>
                                @endforeach
                            </ul>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">Aucun log trouvé.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    @if ($total > $perPage)
        <nav>
            <ul class="pagination">
                @for ($i = 1; $i <= ceil($total / $perPage); $i++)
                    <li class="page-item {{ $i == $page ? 'active' : '' }}">
                        <a class="page-link"
                            href="{{ request()->fullUrlWithQuery(['page' => $i]) }}">{{ $i }}</a>
                    </li>
                @endfor
            </ul>
        </nav>
    @endif
@endsection
