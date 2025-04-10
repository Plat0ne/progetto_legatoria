<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="descrizione" content="il meglio del meglio">
        <meta name="autore" content="Muditha & Alessia">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title> Pannello  {{isset($title) ? '| '.$title : ''}}</title>

         <!-- Font personalizzati per questo template-->
        <link href="{{ asset('admin_assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
        <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet">
        <!-- Stili personalizzati per questo template-->
        <link href="{{ asset('admin_assets/css/sb-admin-2.min.css') }}" rel="stylesheet">
    </head>

    <body id="pagina-inizio">
         <!-- Wrapper della pagina -->
        <div id="wrapper">
            <!-- Barra laterale sinistra -->
            @include('admin.componenti.barra-laterale-scorrevole')
            <!-- Fine della barra laterale sinistra -->

            <!-- Wrapper del contenuto -->
            <div id="content-wrapper" class="d-flex flex-column" style="background: linear-gradient(to right,rgb(193, 215, 237),rgb(129, 169, 179));">
                <!-- Contenuto principale -->
                <div id="content">
                    <!-- Barra superiore -->
                    <nav class="navbar navbar-expand navbar-light bg-dark topbar mb-4 static-top shadow text-white">

                        <!-- Pulsante per aprire o chiudere la barra laterale -->
                        <button id="sidebarToggle" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>

                        <!-- Navbar della barra superiore -->
                        <ul class="navbar-nav ml-auto">

                            <li class="nav-item mx-auto d-flex align-items-center"><strong>Bind it con passione!</strong></li>

                            <div class="topbar-divider d-none d-sm-block"></div>

                            <!-- Informazioni sull'utente -->
                            <li class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="mr-2 small">{{ Auth::user()->name }}</span>
                                    <span class="icon-circle bg-info">
                                        <i class="fas fa-user fa-sm text-dark"></i>
                                    </span>
                                </a>
                                <!-- Dropdown delle informazioni sull'utente -->
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                    aria-labelledby="userDropdown">
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Profilo
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Impostazioni
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Registro delle attività
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Logout
                                    </a>
                                </div>
                            </li>

                        </ul>

                    </nav>
                <!-- Fine della barra superiore -->

                <!-- Inizio del contenuto principale -->
                <div class="container-fluid">
                    <body>
                        @yield('main')

                        {{-- includo i datatable --}}
                        <link rel="stylesheet" href="{{ asset('admin_assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" />
                        <script src="{{ asset('js/datatable-generic.js') }}"></script>
                    </body>

                </div>
                <!-- Fine del contenuto principale -->

                </div>
                <!-- Fine del contenuto principale -->

                <!-- Footer -->
                <footer class="sticky-footer">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>App Bind it, copyright 2025</span>
                        </div>
                    </div>
                </footer>
                <!-- Fine del footer -->

            </div>
            <!-- Fine del wrapper del contenuto -->

        </div>
        <!-- Fine del wrapper della pagina -->

        <!-- Pulsante per tornare in alto -->
        <a class="scroll-to-top rounded" href="#pagina-inizio">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- la modal di logout -->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Vuoi uscire?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Seleziona "Logout" qui sotto se sei pronto ad uscire.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Annulla</button>
                        <form method="POST" action="{{ route('admin.logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-primary">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap core JavaScript-->
        <script src="{{ asset('admin_assets/vendor/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('admin_assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

        <!-- Plugin core JavaScript-->
        <script src="{{ asset('admin_assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

        <!-- Script personalizzati per tutte le pagine-->
        <script src="{{ asset('admin_assets/js/sb-admin-2.min.js') }}"></script>

        <!-- Plugin per le pagine -->
        <script src="{{ asset('admin_assets/vendor/chart.js/Chart.min.js') }}"></script>

        <!-- Script personalizzati per le pagine -->
        <script src="{{ asset('admin_assets/js/demo/chart-area-demo.js') }}"></script>
        <script src="{{ asset('admin_assets/js/demo/chart-pie-demo.js') }}"></script>

        @yield('scripts_pagine_secondarie')
    </body>

</html>

