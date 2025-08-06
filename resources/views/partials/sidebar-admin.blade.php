<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.index') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Ticket App</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Dashboard -->
    <li class="nav-item {{ Request::routeIs('admin.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.index') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Tickets Section -->
    <hr class="sidebar-divider">
    <div class="sidebar-heading">Tickets</div>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="false" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-ticket-alt"></i>
            <span>Gestion des tickets</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('admin.tickets') }}">Tous les tickets</a>
                <a class="collapse-item" href="{{ route('admin.tickets.pending') }}">Tickets en attente</a>
                <a class="collapse-item" href="{{ route('admin.tickets.open') }}">Tickets ouverts</a>
                <a class="collapse-item" href="{{ route('admin.tickets.closed') }}">Tickets clôturés</a>
            </div>
        </div>
    </li>

    <!-- Statistiques Section -->
    <hr class="sidebar-divider">
    <div class="sidebar-heading">Utilitaires</div>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseStats"
            aria-expanded="false" aria-controls="collapseStats">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Statistiques</span>
        </a>
        <div id="collapseStats" class="collapse" aria-labelledby="headingStats" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('admin.stats.overview') }}">Vue d'ensemble</a>
                <a class="collapse-item" href="{{ route('admin.stats.tickets') }}">Stats des tickets</a>
                <a class="collapse-item" href="{{ route('admin.stats.users') }}">Stats des utilisateurs</a>
            </div>
        </div>
    </li>

    <!-- Utilisateurs Section -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUsers"
            aria-expanded="false" aria-controls="collapseUsers">
            <i class="fas fa-fw fa-users-cog"></i>
            <span>Utilisateurs</span>
        </a>
        <div id="collapseUsers" class="collapse" aria-labelledby="headingUsers" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('admin.users') }}">Liste des utilisateurs</a>
                <a class="collapse-item" href="#">Gestion des rôles</a>
                <a class="collapse-item" href="#">Permissions</a>
            </div>
        </div>
    </li>

    <hr class="sidebar-divider d-none d-md-block">
</ul>
