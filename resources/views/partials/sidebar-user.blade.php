<ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('ticket.index') }}">
        <div class="sidebar-brand-icon">
            <i class="fas fa-ticket-alt"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Mes Tickets</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <li class="nav-item {{ Request::routeIs('ticket.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('ticket.index') }}">
            <i class="fas fa-fw fa-home"></i>
            <span>Accueil</span>
        </a>
    </li>

    <li class="nav-item {{ Request::routeIs('ticket.create') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('ticket.create') }}">
            <i class="fas fa-fw fa-plus-circle"></i>
            <span>Créer un ticket</span>
        </a>
    </li>

    <li class="nav-item {{ Request::routeIs('ticket.mytickets') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('ticket.mytickets') }}">
            <i class="fas fa-fw fa-folder-open"></i>
            <span>Mes tickets</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('profile.edit') }}">
            <i class="fas fa-fw fa-user-circle"></i>
            <span>Mon profil</span>
        </a>
    </li>

    <hr class="sidebar-divider d-none d-md-block">
</ul>
