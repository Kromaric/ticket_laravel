<div class="row">

    @php
    $pre = auth()->check() && auth()->user()->isAdmin() ? 'admin.' : 'user.';
    @endphp



    <!-- Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <a href="{{ route($pre . 'tickets.list') }}" style="text-decoration: none; color: inherit;">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Tickets Total</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalTickets }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-ticket-alt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <!-- Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <a href="{{ route($pre . 'tickets.closed') }}" style="text-decoration: none; color: inherit;">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Tickets Résolus</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $ticketsFermes }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <!--  Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <a href="{{ route($pre . 'tickets.open') }}" style="text-decoration: none; color: inherit;">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Tickets en cours</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $ticketsOuverts }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clock fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>


    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <a href="{{ route($pre . 'tickets.pending') }}" style="text-decoration: none; color: inherit;">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Tickets en attente</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $ticketsPending }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-hourglass-half fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
