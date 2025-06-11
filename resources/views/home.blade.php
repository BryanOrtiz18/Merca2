<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi App Laravel</title>
    
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <!-- MDBootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.css" rel="stylesheet">
    
    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <!-- Navbar MDBootstrap -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary shadow-0">
        <div class="container-fluid">
            <!-- Logo/Brand -->
            <a class="navbar-brand" href="#">
                <img src="{{ asset('assets/imgs/logo2.jpeg') }}" height="25" alt="Logo" loading="lazy">
            </a>
            
            <!-- Botón para móviles -->
            <button
                class="navbar-toggler"
                type="button"
                data-mdb-toggle="collapse"
                data-mdb-target="#navbarNav"
                aria-controls="navbarNav"
                aria-expanded="false"
                aria-label="Toggle navigation"
            >
                <i class="fas fa-bars"></i>
            </button>
            
            <!-- Contenido colapsable -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <!-- Menú izquierda -->
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="#"><i class="fas fa-home me-1"></i> Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fa fa-shopping-bag" aria-hidden="true"></i> productos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fa fa-history" aria-hidden="true"></i></i>  Historial de Compras</a>
                    </li>
                </ul>
                
                <!-- Menú derecha -->
                <ul class="navbar-nav">
                    
                    <!-- Avatar y menú usuario -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center hidden-arrow" href="#" id="userDropdown" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                            <img src="https://mdbcdn.b-cdn.net/img/new/avatars/2.webp" class="rounded-circle" height="25" alt="Usuario" loading="lazy">
                            <span class="ms-2 d-none d-sm-inline">
                                @auth
                                    {{ Auth::user()->name }}
                                @else
                                    Usuario
                                @endauth
                            </span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i> Mi perfil</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i> Configuración</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <!-- Logout Laravel -->
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt me-2"></i> Cerrar sesión
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contenido principal -->
    <div class="container mt-4">
        @yield('content')
    </div>

    <!-- MDBootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.js"></script>
    
    <!-- Inicialización de componentes -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Inicializa todos los componentes de MDB
            const { Dropdown, Collapse, Tooltip, initMDB } = mdb;
            initMDB({ Dropdown, Collapse, Tooltip });
            
            // Opcional: Si usas Livewire o Alpine.js
            document.addEventListener('livewire:load', function() {
                initMDB({ Dropdown, Collapse, Tooltip });
            });
        });
    </script>
</body>
</html>