<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome | Bind it!</title>
    <!-- Font personalizzati per questo template-->
    <link href="{{ asset('admin_assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Stili personalizzati per questo template-->
    <link href="{{ asset('admin_assets/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        body {
            height: 100vh;
            background: linear-gradient(to right,rgb(193, 215, 237),rgb(129, 169, 179));
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
        }
        footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 2.5rem;
            line-height: 2.5rem;
            color: white;
            text-align: center;
        }
        .welcome-box {
            padding: 40px;
            border-radius: 15px;
            background-color: rgba(0, 0, 0, 0.8);
            text-align: center;
            width: 90%;
        }
        .welcome-box h1 {
            font-size: 2rem;
            margin-bottom: 20px;
        }
        .btn-dashboard {
            color:rgb(0, 0, 0);
            border: none;
            font-weight: bold;
        }
        .btn-dashboard:hover {
            background-color: #e2e6ea;
            color: #0056b3;
        }
        .clock-container {
            position: absolute;
            top: 20px;
            right: 0;
            font-size: 3rem;
            font-weight: bold;
            text-align: right;
        }

    </style>
</head>
<body style="background: url('{{ asset('admin_assets/img/login_background.jpg') }}') no-repeat center center fixed; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;">


    <div id="alerts" style="position: fixed; top: 0; left: 0; right: 100; z-index: 9999;">
        @if (session('success'))
            <div class="alert alert-solid-success text-success" style="background-color:rgba(0, 0, 0, 0.81);">
                <i class="fas fa-check-circle"></i>
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-solid-danger text-danger" style="background-color:rgba(0, 0, 0, 0.81);">
                <i class="fas fa-exclamation-circle"></i>
                {{ session('error') }}
            </div>
        @endif
    </div>

    <div class="clock-container d-lg-block">
        <span id="clock"></span>
    </div>
    <div style="position: fixed; top: 0; left: 0;" class="d-lg-block">
        <a href="{{ route('produzione.home') }}" class="btn btn-success mt-3 m">Produzione</a>
    </div>

    <div id="welcome_box" class="welcome-box">
        <h1 id="messaggio_benvenuto"><strong>Benvenuto {{ session('name') }}!</strong></h1>
        <p class="mb-4"><strong>Accedi alla tua area personale per gestire il tuo profilo e i tuoi progetti.</strong></p>
        <button id="enter_app_button" onclick="enter_app()" class="btn btn-dashboard btn-lg bg-info"><strong>{{auth()->check() ? 'Entra al Dashboard' : 'Accedi'}}</strong></button>
    </div>

    <div id="login_bar" class="d-none col-xl-12 col-md-12 col-md-12">
        <div style="display: flex; justify-content: center; align-items: center; height: 100vh;">
            <div class="card-body p-0">
                <div class="w-100">
                    <div style="background-color: rgba(0, 0, 0, 0.8);" class="p-5 card">
                        <form class="user w-100" onsubmit="event.preventDefault(); loginAttempt();">
                            @csrf

                            <div class="form-group">
                                <input type="email" name="email" class="form-control form-control-user w-100 px-3"
                                    id="email_input" aria-describedby="emailHelp"
                                    placeholder="Inserisci indirizzo Email" value="{{ old('email') }}">
                            </div>

                            <div class="form-group">
                                <input type="password" name="password" class="form-control form-control-user w-100 px-3"
                                    id="input_pw" placeholder="Password">
                            </div>

                            <div id="login_error" class="text-danger text-center mt-2 d-none"></div>

                            @if ($errors->has('all'))
                                <div id="error_message" class="text-danger text-bg text-center">{{ $errors->first('all') }}</div>
                            @endif

                            <button type="submit" class="btn btn-primary btn-user btn-block w-100">
                                Login
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const alerts = document.getElementById('alerts');
        setTimeout(() => {
            alerts.style.transition = "opacity 1s";
            alerts.style.opacity = 0;
            setTimeout(() => alerts.remove(), 1000);
        }, 3000);

        function enter_app() {
            if ({{ auth()->check() ? 'true' : 'false' }}) {
                window.location.replace("admin/dashboard");
            } else {
                document.getElementById('login_bar').classList.remove('d-none');
                document.getElementById('welcome_box').classList.add('d-none');
            }
        }

        async function loginAttempt() {
            const email = document.getElementById('email_input').value;
            const password = document.getElementById('input_pw').value;
            const errorDiv = document.getElementById('login_error');

            // Nasconde eventuali errori precedenti
            errorDiv.classList.add('d-none');
            errorDiv.textContent = '';

            try {
                const response = await fetch("/admin/login", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        'Accept': 'application/json',
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ email, password })
                });

                const data = await response.json();

                if (response.ok && data.success) {
                    window.location.reload();
                } else {
                    // Mostra messaggio di errore
                    errorDiv.classList.remove('d-none');
                    errorDiv.textContent = data.message || "Login fallito";
                }

            } catch (err) {
                errorDiv.classList.remove('d-none');
                errorDiv.textContent = "Errore di rete o server non raggiungibile.";
                console.error("Errore AJAX:", err);
            }
        }

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
<!-- Footer -->
<footer class="sticky-footer">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>App Bind it, copyright 2025</span>
        </div>
    </div>
</footer>
<!-- Fine del footer -->
</html>

