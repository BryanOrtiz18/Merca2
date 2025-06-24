@extends('layouts.app')

@section('title', 'Inventario - MERCA2')

@section('content')
 
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
                    <a class="nav-link" href="{{ route('proveedores.index') }}">
                      <i class="bi bi-box-seam-fill me-1"></i> Proveedores
                    </a>
                </li>

                </li>
                 <li class="nav-item">
                    <a class="nav-link" href="{{ route('products.index') }}">
                       <i class="bi bi-laptop-fill me-1"></i>Inventario. P
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
    <!-- CONTENIDO -->
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Inventario de Productos</h1>
            <a href="{{ route('products.create') }}" class="btn btn-primary shadow-sm">
                <i class="fas fa-plus-circle mr-2"></i> Nuevo Producto
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
        @endif

        <div class="card shadow mb-4">
            <div class="card-header py-3 bg-light">
                <h6 class="m-0 font-weight-bold text-primary">Listado Completo</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th>Código</th>
                                <th>Nombre</th>
                                <th>Precio Compra</th>
                                <th>Precio Venta</th>
                                <th>Stock</th>
                                <th>Mínimo</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                            <tr class="{{ $product->stock < $product->min_stock ? 'table-warning' : '' }}">
                                <td>{{ $product->barcode }}</td>
                                <td>{{ $product->name }}</td>
                                <td>${{ number_format($product->purchase_price, 2) }}</td>
                                <td>${{ number_format($product->sale_price, 2) }}</td>
                                <td class="{{ $product->stock < $product->min_stock ? 'font-weight-bold text-danger' : '' }}">
                                    {{ $product->stock }}
                                </td>
                                <td>{{ $product->min_stock }}</td>
                                <td>
                                    <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('products.destroy', $product) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Eliminar" onclick="return confirm('¿Eliminar este producto?')">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $products->links() }}
            </div>
        </div>
    </div>

    <style>
        .table-hover tbody tr:hover {
            background-color: rgba(0, 0, 0, 0.03);
        }

        .table-warning {
            background-color: rgba(255, 193, 7, 0.1);
        }

        .table-warning:hover {
            background-color: rgba(255, 193, 7, 0.15) !important;
        }
    </style>
@endsection
