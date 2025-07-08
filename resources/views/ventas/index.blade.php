   <!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="{{ url('/home') }}">
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
        <h1 class="my-4 text-center">Registro de Ventas <small class="text-muted">(Córdobas NIO)</small></h1>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="d-flex justify-content-between mb-4">
            <a href="{{ route('ventas.create') }}" class="btn btn-success">
                <i class="fas fa-plus"></i> Nueva Venta
            </a>
            <div class="bg-light p-2 rounded">
                <strong>Total Hoy:</strong> C$ {{ number_format($totalHoy, 2) }}
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th># Factura</th>
                        <th>Cliente</th>
                        <th>RUC</th>
                        <th>Total (C$)</th>
                        <th>Fecha</th>
                        <th>Tipo Pago</th>
                        <th>Vendedor</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ventas as $venta)
                    <tr>
                        <td>{{ str_pad($venta->id, 6, '0', STR_PAD_LEFT) }}</td>
                        <td>{{ $venta->cliente }}</td>
                        <td>{{ $venta->ruc ?? 'N/D' }}</td>
                        <td class="text-end">{{ $venta->total_formateado }}</td>
                        <td>{{ $venta->fecha->format('d/m/Y') }}</td>
                        <td>{{ $venta->tipo_pago }}</td>
                        <td>{{ $venta->vendedor }}</td>
                        <td class="text-center">
    <div class="d-flex justify-content-center gap-2 flex-wrap">
        <form action="{{ route('ventas.show', $venta->id) }}" method="GET">
            <button type="submit" class="btn btn-info btn-sm d-flex align-items-center justify-content-center" title="Ver">
                <i class="fas fa-eye"></i>
            </button>
        </form>

        <form action="{{ route('ventas.edit', $venta->id) }}" method="GET">
            <button type="submit" class="btn btn-warning btn-sm d-flex align-items-center justify-content-center" title="Editar">
                <i class="fas fa-edit"></i>
            </button>
        </form>

        <form action="{{ route('ventas.destroy', $venta->id) }}" method="POST" onsubmit="return confirm('¿Confirmar eliminación?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm d-flex align-items-center justify-content-center" title="Eliminar">
                <i class="fas fa-trash-alt"></i>
            </button>
        </form>
    </div>
</td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $ventas->links() }}
        </div>
    </div>
@endsection
