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

@section('title', 'Editar Venta - MERCA2')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Editar Venta #{{ str_pad($venta->id, 6, '0', STR_PAD_LEFT) }}</h1>
        <a href="{{ route('ventas.index') }}" class="btn btn-secondary shadow-sm">
            <i class="fas fa-arrow-left me-2"></i> Regresar
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3 bg-light">
            <h6 class="m-0 font-weight-bold text-primary">Modificar Datos de la Venta</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('ventas.update', $venta->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="cliente" class="form-label">Cliente *</label>
                        <input type="text" class="form-control" id="cliente" name="cliente" value="{{ old('cliente', $venta->cliente) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="ruc" class="form-label">RUC</label>
                        <input type="text" class="form-control" id="ruc" name="ruc" value="{{ old('ruc', $venta->ruc) }}">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="total" class="form-label">Total (C$) *</label>
                        <input type="number" step="0.01" class="form-control" id="total" name="total" value="{{ old('total', $venta->total) }}" required>
                    </div>
                    <div class="col-md-4">
                        <label for="fecha" class="form-label">Fecha *</label>
                        <input type="date" class="form-control" id="fecha" name="fecha" value="{{ old('fecha', $venta->fecha->format('Y-m-d')) }}" required>
                    </div>
                    <div class="col-md-4">
                        <label for="tipo_pago" class="form-label">Tipo de Pago *</label>
                        <select class="form-select" id="tipo_pago" name="tipo_pago" required>
                            <option value="Contado" {{ old('tipo_pago', $venta->tipo_pago) == 'Contado' ? 'selected' : '' }}>Contado</option>
                            <option value="Crédito" {{ old('tipo_pago', $venta->tipo_pago) == 'Crédito' ? 'selected' : '' }}>Crédito</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="productos" class="form-label">Productos *</label>
                    <textarea class="form-control" id="productos" name="productos" rows="3" required>{{ old('productos', $venta->productos) }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="vendedor" class="form-label">Vendedor *</label>
                    <input type="text" class="form-control" id="vendedor" name="vendedor" value="{{ old('vendedor', $venta->vendedor) }}" required>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-2"></i> Actualizar Venta
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
