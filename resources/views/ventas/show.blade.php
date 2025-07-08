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
            <ul class="navbar-nav me-auto">
                <!-- Enlace al home con ícono de casa -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">
                        <i class="fas fa-home me-1"></i> Inicio
                    </a>

                </li>
                 <li class="nav-item">
                    <a class="nav-link" href="{{ route('products.index') }}">
                      <i class="bi bi-box-seam-fill me-1"></i> Proveedores
                    </a>
                </li>

                </li>
                 <li class="nav-item">
                    <a class="nav-link" href="{{ route('products.index') }}">
                       <i class="bi bi-laptop-fill me-1"></i>Inventario
                    </a>
                </li>
            <
            </ul>

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

<br>
@extends('layouts.app')

@section('title', 'Detalle de Venta')

@section('content')
<div class="container">
    <h2 class="mb-4">Detalle de la Venta #{{ str_pad($venta->id, 6, '0', STR_PAD_LEFT) }}</h2>

    <div class="card mb-3">
        <div class="card-header bg-light">
            <strong>Información del Cliente</strong>
        </div>
        <div class="card-body">
            <p><strong>Cliente:</strong> {{ $venta->cliente }}</p>
            <p><strong>RUC:</strong> {{ $venta->ruc ?? 'N/D' }}</p>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-header bg-light">
            <strong>Datos de la Venta</strong>
        </div>
        <div class="card-body">
            <p><strong>Total:</strong> C$ {{ number_format($venta->total, 2) }}</p>
            <p><strong>Fecha:</strong> {{ $venta->fecha }}</p>
            <p><strong>Tipo de Pago:</strong> {{ $venta->tipo_pago }}</p>
            <p><strong>Vendedor:</strong> {{ $venta->vendedor }}</p>
            <p><strong>Productos:</strong> {{ $venta->productos }}</p>
        </div>
    </div>

    <a href="{{ route('ventas.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Regresar
    </a>
</div>
@endsection
