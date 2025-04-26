@php
    $rotta_corrente=request()->route()->getName();
@endphp


<ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center bg-info text-dark" href="{{ route('admin.dashboard') }}">
        <i class="fas fa-fw fa-book"></i>
        <div class="sidebar-brand-text mx-3">Benvenuto {{ auth()->user()->name }} </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a href="{{ route('admin.dashboard') }}" class="nav-link {{ $rotta_corrente=='admin.dashboard'?'active':'' }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Pannello di controllo</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interfaccia
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="far fa-fw fa-clock"></i>
            <span></span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="py-2 collapse-inner rounded bg-info">
                <h6 class="collapse-header text-white">Tempi lavorazione fasi:</h6>
                <a class="collapse-item" href="{{ route('lavorazioni_taglio.index') }}"><i class="fas fa-fw fa-cut"></i> Taglio</a>
                <a class="collapse-item" href="{{ route('lavorazioni_piega.index') }}"><i class="fas fa-fw fa-layer-group"></i> Piega</a>
                <a class="collapse-item" href="{{ route('lavorazioni_raccolta.index') }}"><i class="fas fa-fw fa-people-carry"></i> Raccolta</a>
                <a class="collapse-item" href="{{ route('lavorazioni_cucitura.index') }}"><i class="fas fa-dot-circle"></i> Cucitura</a>
                <a class="collapse-item" href="{{ route('lavorazioni_brossura.index') }}"><i class="fas fa-book-open"></i> Brossura</a>
                
            </div>
        </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span></span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner">
                <h6 class="collapse-header">Monitoring Azienda:</h6>
                <a class="collapse-item" href="{{ route('admin.statistiche.fasi') }}">Statistiche Fasi</a>
                <a class="collapse-item" href="{{ route('admin.dashboard') }}">Orari operatori</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Gestione Personale
    </div>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse_gestione_personale"
            aria-expanded="true" aria-controls="collapse_gestione_personale">
            <i class="fas fa-fw fa-user"></i>
            <span></span>
        </a>
        <div id="collapse_gestione_personale" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-info text-white py-2 collapse-inner rounded">
                <h6 class="collapse-header text-white">Gestione Personale:</h6>

                <a class="collapse-item" href="{{ route('admin.utenti.index') }}">
                    <i class="fas fa-fw fa-user bg-primary rounded"></i>
                    Utenti</a>

                <a class="collapse-item" href="{{ route('operatori.index') }}">
                    <i class="fas fa-fw fa-hard-hat bg-warning rounded"></i>
                    Operatori</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Charts -->
    {{-- <li class="nav-item">
        <a class="nav-link {{ $rotta_corrente == 'admin.utenti.index' ? 'active' : '' }}" href="{{ route('admin.utenti.index') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>Utenti</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ $rotta_corrente == 'admin.operatori.index' ? 'active' : '' }}" href="{{ route('operatori.index') }}">
            <i class="fas fa-fw fa-hard-hat"></i>
            <span>Operatori</span></a>
    </li> --}}

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>

