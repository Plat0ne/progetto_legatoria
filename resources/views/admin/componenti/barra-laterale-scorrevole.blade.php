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
            <i class="fas fa-fw fa-cog"></i>
            <span>Componenti</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Componenti personalizzati:</h6>
                <a class="collapse-item" href="{{ route('admin.dashboard') }}">Bottoni</a>
                <a class="collapse-item" href="{{ route('admin.dashboard') }}">Schede</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Strumenti</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Strumenti personalizzati:</h6>
                <a class="collapse-item" href="{{ route('admin.dashboard') }}">Colori</a>
                <a class="collapse-item" href="{{ route('admin.dashboard') }}">Bordi</a>
                <a class="collapse-item" href="{{ route('admin.dashboard') }}">Animazioni</a>
                <a class="collapse-item" href="{{ route('admin.dashboard') }}">Altro</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Gestione Personale
    </div>

    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link {{ $rotta_corrente == 'admin.utenti.index' ? 'active' : '' }}" href="{{ route('admin.utenti.index') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>Utenti</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ $rotta_corrente == 'admin.operatori.index' ? 'active' : '' }}" href="{{ route('operatori.index') }}">
            <i class="fas fa-fw fa-hard-hat"></i>
            <span>Operatori</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>

