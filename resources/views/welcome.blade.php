<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap CSS desde CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- MDBootstrap (Material Design for Bootstrap) desde CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.css" rel="stylesheet">
    
    <!-- Font Awesome para íconos -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <!-- Estilos personalizados -->
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f8fafc; /* Fondo claro similar al original */
        }
        /* Ajuste para que el contenido no quede detrás del navbar fijo */
        .main-content {
            min-height: calc(100vh - 120px); /* Altura mínima del viewport menos el footer */
            padding-top: 80px; /* Espacio para el navbar fijo */
        }

        
    </style>
</head>
<body>
    <!-- ============================================ -->
    <!-- Barra de Navegación Principal -->
    <!-- ============================================ -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top">
        <div class="container">
            <!-- Logo/Marca -->
            <a class="navbar-brand me-2" href="{{ url('/') }}">
                <img src= "{{ asset('assets/imgs/logo2.jpeg') }}"
                     height="20" 
                     alt="Logo MDB" 
                     loading="lazy" 
                     style="margin-top: -1px;">
            </a>

            <!-- Botón para móviles -->
            <button class="navbar-toggler" 
                    type="button" 
                    data-mdb-toggle="collapse" 
                    data-mdb-target="#navbarButtonsExample" 
                    aria-controls="navbarButtonsExample" 
                    aria-expanded="false" 
                    aria-label="Mostrar/Ocultar menú">
                <i class="fas fa-bars"></i>
            </button>

            <!-- Contenido colapsable -->
            <div class="collapse navbar-collapse" id="navbarButtonsExample">
                <!-- Menú principal (lado izquierdo) -->
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    
                </ul>

                <!-- Botones (lado derecho) -->
                <div class="d-flex align-items-center">
                    @auth
                        <!-- Si el usuario ESTÁ autenticado -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-link px-3 me-2">Cerrar sesión</button>
                        </form>
                        <a href="{{ url('/home') }}" class="btn btn-primary me-3">Panel</a>
                    @else
                        <!-- Si el usuario NO está autenticado -->
                        <a href="{{ route('login') }}" class="btn btn-link px-3 me-2">Iniciar sesión</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-primary me-3">Registrarse</a>
                        @endif
                    @endauth
                    
                    <!-- Botón GitHub -->
                
                </div>
            </div>
        </div>
    </nav>

    <!-- ============================================ -->
    <!-- Contenido Principal -->
    <!-- ============================================ -->
    <main class="main-content">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <!-- Tarjeta principal -->
                    <div class="card">
                        <div class="card-header">
                            <h1 class="text-center">¡Bienvenidos a Merca2! </h1>
                        </div>

                        <div class="card-body">
                            <!-- Mostrar mensaje de estado si existe -->
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <p class="text-center">¡En Merca2 encontrarás productos, 
                                <br>precios justos y atención cercana, pensada para hacer tu día más fácil.!</p>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- ============================================ -->
    <!-- Pie de Página -->
    <!-- ============================================ -->


    <!-- Scripts -->
    <!-- MDBootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/mdb-ui-kit@6.4.0/js/mdb.min.js"></script>
    <!-- Bootstrap JS Bundle con Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>