<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="descrizione" content="il meglio del meglio">
        <meta name="autore" content="Muditha & Alessia">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title> Pannello  {{isset($title) ? '| '.$title : ''}}</title>

        <!-- Font personalizzati per questo template-->
        <link href="{{ asset('admin_assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

        <!-- Stili personalizzati per questo template-->
        <link href="{{ asset('admin_assets/css/sb-admin-2.min.css') }}" rel="stylesheet">

        <!-- per il date range picker -->
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

        <style>
        .clock-container {
            font-size: 2.5rem;
            font-weight: bold;
            text-align: right;
        }
        </style>

        @vite(['resources/css/fill.css'])
    </head>

    <body id="pagina-inizio" class="bg-success">
        <!-- Wrapper della pagina -->
        
        <div id="" class="">
            <!-- Inizio del contenuto principale -->
            <div class="container-fluid">
                <div class="clock-container d-lg-block text-dark mr-3">
                    <span id="clock" style="text-shadow: -2px 0 white, 0 2px white, 2px 0 white, 0 -2px white;"></span>
                </div>
                <h1 class="mb-4 text-dark" style="text-shadow: -2px 0 white, 0 2px white, 2px 0 white, 0 -2px white;">
                    <strong>
                        @yield('icon')
                        {{ $title }}
                    </strong>
                </h1>

                @if (Route::currentRouteName() != 'produzione.home')
                    <div class="d-flex justify-content-center">
                        <a href="{{ route('produzione.home') }}" class="btn btn-light btn-lg mb-3">
                            <i class="fas fa-home"></i>
                        </a>
                    </div>
                @endif

                <hr style="border-color: white; border-width: 3px;">

                @yield('main')

            </div>
            <!-- Fine del contenuto principale -->

            <!-- Footer -->
            <footer class="sticky-footer">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto text-white">
                        <span>App Bind it, copyright 2025</span>
                    </div>
                </div>
            </footer>
            <!-- Fine del footer -->
        </div>
        <!-- Fine del wrapper del contenuto -->

        <!-- Pulsante per tornare in alto -->
        <a class="scroll-to-top rounded" href="#pagina-inizio">
            <i class="fas fa-angle-up"></i>
        </a>
        <!-- jQuery -->
        <script src="{{ asset('admin_assets/vendor/jquery/jquery.min.js') }}"></script>

        <!-- Bootstrap Bundle (include Popper) -->
        <script src="{{ asset('admin_assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

        <!-- jQuery Easing -->
        <script src="{{ asset('admin_assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

        <!-- Moment.js + lingua italiana (per daterangepicker) -->
        <script src="https://cdn.jsdelivr.net/npm/moment@2.29.4/min/moment.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/moment/locale/it.js"></script>

        <!-- Script admin personalizzati -->
        <script src="{{ asset('admin_assets/js/sb-admin-2.min.js') }}"></script>

        <!-- script personalizzati per le pagine secondarie -->          
        @yield('scripts_pagine_secondarie')

        <script>
            function updateTime() {
                const date = new Date();
                const hours = date.getHours();
                const minutes = date.getMinutes();
                const seconds = date.getSeconds();
                const time = `${hours < 10 ? '0' + hours : hours}:${minutes < 10 ? '0' + minutes : minutes}:${seconds < 10 ? '0' + seconds : seconds}`;
                document.getElementById('clock').innerHTML = time;
            }
            setInterval(updateTime, 1000);
            updateTime();
        </script>
    </body>

</html>

