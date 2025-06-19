<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio - MERCA2 Mini Market</title>
    
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <style>
        .card-img-overlay {
            border-radius: 0.5rem;
        }
        .feature-card {
            transition: transform 0.3s;
        }
        .feature-card:hover {
            transform: translateY(-5px);
        }
        .bg-gradient {
            background: linear-gradient(45deg, transparent, rgba(255,255,255,0.2));
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="{{ url('/') }}">
                <i class="fas fa-store-alt me-2"></i> MERCA2  
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarMain">
                @auth
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user-circle me-1"></i> {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                        
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="fas fa-sign-out-alt me-2"></i> Cerrar sesión
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
                @endauth
            </div>
        </div>
    </nav>




    

    <div class="container my-4">
        <!-- Banner Principal -->
        <div class="card bg-dark text-white mb-4">
            <img src="{{ asset('assets/imgs/minimarket.jpg') }}" alt="Banner" class="card-img" style="height: 300px; object-fit: cover;">
            <div class="card-img-overlay d-flex flex-column justify-content-center" style="background-color: rgba(0, 0, 0, 0.5);">
                <h1 class="card-title display-4 fw-bold">Bienvenido a MERCA2</h1>
                <p class="card-text lead">Tu solución integral para la gestión de mini mercados</p>
                @auth
            
                @endauth
            </div>
        </div>
<div class="row mb-5">

    <!-- VENTAS Y REGISTROS -->
    <div class="col-md-4 mb-4">
        <div class="card h-100 shadow-sm feature-card position-relative">
            <div class="card-body text-center">
                <div class="bg-primary bg-gradient rounded-circle d-inline-flex justify-content-center align-items-center mb-3"
                     style="width: 70px; height: 70px;">
                    <i class="bi bi-cash-coin text-white" style="font-size: 2rem;"></i>
                    
                </div>
                <h3 class="card-title">Ventas y Registros</h3>
                <p class="card-text">Registro de todas las ventas realizadas</p>
                <a href="{{ route('sales.index') }}" class="stretched-link"></a>
            </div>
        </div>
    </div>

    <!-- Compras y Proveedores -->
    <div class="col-md-4 mb-4">
        <div class="card h-100 shadow-sm feature-card position-relative">
            <div class="card-body text-center">
                <div class="bg-success bg-gradient rounded-circle d-inline-flex justify-content-center align-items-center mb-3"
                     style="width: 70px; height: 70px;">
                    <i class="bi bi-box-seam-fill text-white" style="font-size: 2rem;"></i>
                </div>
                <h3 class="card-title">Compras y Proveedoress</h3>
                <p class="card-text">Registrar compras realizadas y registra proveedore</p>
                <a href="{{ route('reports.index') }}" class="stretched-link"></a>
            </div>
        </div>
    </div>

    <!-- INVENTARIO -->
    <div class="col-md-4 mb-4">
        <div class="card h-100 shadow-sm feature-card position-relative">
            <div class="card-body text-center">
                <div class="bg-info bg-gradient rounded-circle d-inline-flex justify-content-center align-items-center mb-3"
                     style="width: 70px; height: 70px;">
                    <i class="bi bi-laptop-fill text-white" style="font-size: 2rem;"></i>
                </div>
                <h3 class="card-title">Inventario</h3>
                <p class="card-text">Ver todos los productos</p>
                <a href="{{ route('products.index') }}" class="stretched-link"></a>
            </div>
        </div>
    </div>





    <!-- Punto de Venta -->
    <div class="col-md-4 mb-4">
        <div class="card h-100 shadow-sm feature-card position-relative">
            <div class="card-body text-center">
                <div class="bg-primary bg-gradient rounded-circle d-inline-flex justify-content-center align-items-center mb-3"
                     style="width: 70px; height: 70px;">
                    <i class="bi bi-cash-coin text-white" style="font-size: 2rem;"></i>
                </div>
                <h3 class="card-title">productos</h3>
                <p class="card-text">Sistema de ventas rápido e intuitivo con control de inventario en tiempo real.</p>
                <a href="{{ route('products.index') }}" class="stretched-link"></a>
            </div>
        </div>
    </div>

    <!-- Reportes y Análisis -->
    <div class="col-md-4 mb-4">
        <div class="card h-100 shadow-sm feature-card position-relative">
            <div class="card-body text-center">
                <div class="bg-success bg-gradient rounded-circle d-inline-flex justify-content-center align-items-center mb-3"
                     style="width: 70px; height: 70px;">
                    <i class="bi bi-bar-chart-line-fill text-white" style="font-size: 2rem;"></i>
                </div>
                <h3 class="card-title">Reportes y Análisis</h3>
                <p class="card-text"> Reportes filtrables por día/semana/mes</p>
                <a href="{{ route('reports.index') }}" class="stretched-link"></a>
            </div>
        </div>
    </div>

    <!-- Acceso Multiplataforma -->
    <div class="col-md-4 mb-4">
        <div class="card h-100 shadow-sm feature-card position-relative">
            <div class="card-body text-center">
                <div class="bg-info bg-gradient rounded-circle d-inline-flex justify-content-center align-items-center mb-3"
                     style="width: 70px; height: 70px;">
                    <i class="bi bi-laptop-fill text-white" style="font-size: 2rem;"></i>
                </div>
                <h3 class="card-title">Acceso Multiplataforma</h3>
                <p class="card-text">Accede desde cualquier dispositivo con navegador web.</p>
                <a href="{{ route('login') }}" class="stretched-link"></a>
            </div>
        </div>
    </div>



    
    <!-- Punto de Venta -->
    <div class="col-md-4 mb-4">
        <div class="card h-100 shadow-sm feature-card position-relative">
            <div class="card-body text-center">
                <div class="bg-primary bg-gradient rounded-circle d-inline-flex justify-content-center align-items-center mb-3"
                     style="width: 70px; height: 70px;">
                    <i class="bi bi-cash-coin text-white" style="font-size: 2rem;"></i>
                </div>
                <h3 class="card-title">Punto de Venta</h3>
                <p class="card-text">Sistema de ventas rápido e intuitivo con control de inventario en tiempo real.</p>
                <a href="{{ route('sales.index') }}" class="stretched-link"></a>
            </div>
        </div>
    </div>

    <!-- Reportes Avanzados -->
    <div class="col-md-4 mb-4">
        <div class="card h-100 shadow-sm feature-card position-relative">
            <div class="card-body text-center">
                <div class="bg-success bg-gradient rounded-circle d-inline-flex justify-content-center align-items-center mb-3"
                     style="width: 70px; height: 70px;">
                    <i class="bi bi-bar-chart-line-fill text-white" style="font-size: 2rem;"></i>
                </div>
                <h3 class="card-title">Reportes Avanzados</h3>
                <p class="card-text">Genera reportes detallados de ventas, inventario y ganancias.</p>
                <a href="{{ route('reports.index') }}" class="stretched-link"></a>
            </div>
        </div>
    </div>

    <!-- Acceso Multiplataforma -->
    <div class="col-md-4 mb-4">
        <div class="card h-100 shadow-sm feature-card position-relative">
            <div class="card-body text-center">
                <div class="bg-info bg-gradient rounded-circle d-inline-flex justify-content-center align-items-center mb-3"
                     style="width: 70px; height: 70px;">
                    <i class="bi bi-laptop-fill text-white" style="font-size: 2rem;"></i>
                </div>
                <h3 class="card-title">Acceso Multiplataforma</h3>
                <p class="card-text">Accede desde cualquier dispositivo con navegador web.</p>
                <a href="{{ route('login') }}" class="stretched-link"></a>
            </div>
        </div>
    </div>



</div>
    </div>

    <!-- Bootstrap Bundle JS (con Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>



