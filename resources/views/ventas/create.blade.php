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
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-4">Registrar Nueva Venta</h1>

        <form action="{{ route('ventas.store') }}" method="POST" class="needs-validation" novalidate>
            @csrf

            <div class="row g-3">
                <div class="col-md-6">
                    <label for="cliente" class="form-label">Nombre del Cliente *</label>
                    <input type="text" class="form-control" id="cliente" name="cliente" required>
                    <div class="invalid-feedback">Por favor ingrese el nombre del cliente.</div>
                </div>

                <div class="col-md-6">
                    <label for="ruc" class="form-label">RUC (Opcional)</label>
                    <input type="text" class="form-control" id="ruc" name="ruc" placeholder="J0310000000000" maxlength="14">
                </div>

                <div class="col-md-6">
                    <label for="fecha" class="form-label">Fecha *</label>
                    <input type="date" class="form-control" id="fecha" name="fecha" value="{{ $fechaActual }}" required>
                </div>

                <div class="col-md-6">
                    <label for="vendedor" class="form-label">Vendedor *</label>
                    <input type="text" class="form-control" id="vendedor" name="vendedor" required>
                </div>

                <div class="col-md-6">
                    <label for="tipo_pago" class="form-label">Tipo de Pago *</label>
                    <select class="form-select" id="tipo_pago" name="tipo_pago" required>
                        <option value="Contado">Contado</option>
                        <option value="Crédito">Crédito</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="total" class="form-label">Total (C$) *</label>
                    <div class="input-group">
                        <span class="input-group-text">C$</span>
                        <input type="number" step="0.01" class="form-control" id="total" name="total" required>
                    </div>
                </div>

                <div class="col-12">
                    <label for="productos" class="form-label">Productos/Servicios *</label>
                    <textarea class="form-control" id="productos" name="productos" rows="4" required placeholder="Ej: 1 - POLLO - C$ 250.00"></textarea>
                    <small class="text-muted">Formato recomendado: Cantidad - Descripción - Precio Unitario</small>
                </div>
            </div>

            <hr class="my-4">

            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a href="{{ route('ventas.index') }}" class="btn btn-secondary me-md-2">
                    <i class="fas fa-times"></i> Cancelar
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Guardar Venta
                </button>
            </div>
        </form>
    </div>

    <script>
        // Validación del formulario
        (function () {
            'use strict'
            const forms = document.querySelectorAll('.needs-validation')
            
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
        })()
    </script>
@endsection