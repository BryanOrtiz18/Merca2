@extends('layouts.app')

@section('title', 'Proveedores - MERCA2')

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
                

                </li>
                 <li class="nav-item">
                    <a class="nav-link" href="{{ route('products.index') }}">
                       <i class="bi bi-laptop-fill me-1"></i>Inventario. P
                    </a>
                </li>
                
                 <li class="nav-item">
                    <a class="nav-link" href="{{ route('products.index') }}">
                       <i class="bi bi-laptop-fill me-1"></i>Registro. V
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
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Gestión de Proveedores</h1>
        <div>
            <a href="{{ route('proveedores.create') }}" class="btn btn-primary shadow-sm">
                <i class="fas fa-plus-circle mr-2"></i> Nuevo Proveedor
            </a>
            <div class="btn-group ml-2">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-download mr-1"></i> Exportar
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#"><i class="fas fa-file-excel mr-2 text-success"></i> Excel</a>
                    <a class="dropdown-item" href="#"><i class="fas fa-file-pdf mr-2 text-danger"></i> PDF</a>
                </div>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3 bg-light d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Listado de Proveedores</h6>
            <div class="row">
                <div class="col-md-6">
                    <input type="text" id="searchInput" class="form-control form-control-sm" placeholder="Buscar...">
                </div>
                <div class="col-md-6">
                    <select class="form-control form-control-sm" id="statusFilter">
                        <option value="">Todos</option>
                        <option value="1">Activos</option>
                        <option value="0">Inactivos</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="proveedoresTable">
                    <thead class="thead-light">
                        <tr>
                            <th width="20%">Nombre</th>
                            <th width="15%">RUC</th>
                            <th width="20%">Contacto</th>
                            <th width="15%">Teléfono/Email</th>
                            <th width="20%">Dirección</th>
                            <th width="15%">Estado</th>
                            <th width="15%">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($proveedores as $proveedor)
                        <tr>
                            <td>
                                <strong>{{ $proveedor->nombre }}</strong><br>
                                <small class="text-muted">{{ $proveedor->email }}</small>
                            </td>
                            <td>{{ $proveedor->rtn ?? 'N/A' }}</td>
                            <td>
                                <i class="fas fa-user mr-1 text-muted"></i> {{ $proveedor->nombre_contacto }}<br>
                            </td>
                           
                            <td>
                         @if($proveedor->telefono)
                         <a href="tel:{{ $proveedor->telefono }}">
                             <i class="fas fa-phone me-1"></i> {{ substr($proveedor->telefono, 0, 4) . ' ' . substr($proveedor->telefono, 4) }}
                        </a><br>

                         @endif

                        @if($proveedor->email)
                        <a href="mailto:{{ $proveedor->email }}">
                            <i class="fas fa-envelope me-1"></i> {{ $proveedor->email }}
                        </a>
                         @endif
                        </td>
                        
            <td>
            <i class="fas fa-map-marker-alt me-1 text-muted"></i>
                <small>{{ Str::limit($proveedor->direccion, 40) ?? 'Sin dirección' }}</small>
            </td>
                            <td class="text-center" >
                                @if($proveedor->activo)
                                <span class="badge bg-success text-white p-2 ">
                                    <i class="fas fa-check-circle mr-1 "></i> Activo
                                </span>
                                @else
                                <span class="badge bg-danger text-white p-2">
                                    <i class="fas fa-times-circle mr-1"></i> Inactivo
                                </span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('proveedores.show', $proveedor) }}" class="btn btn-sm btn-info mr-1" title="Ver">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    
                                    <a href="{{ route('proveedores.edit', $proveedor) }}" class="btn btn-sm btn-primary mr-1" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('proveedores.destroy', $proveedor) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Eliminar" onclick="return confirm('¿Está seguro de eliminar este proveedor?')">
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
            <div class="d-flex justify-content-between align-items-center mt-3">
                <div class="text-muted">
                    Mostrando {{ $proveedores->firstItem() }} a {{ $proveedores->lastItem() }} de {{ $proveedores->total() }} registros
                </div>
                {{ $proveedores->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Búsqueda en tiempo real (filtro en el cliente)
    $('#searchInput').keyup(function() {
        const searchText = $(this).val().toLowerCase();
        $('#proveedoresTable tbody tr').each(function() {
            const rowText = $(this).text().toLowerCase();
            $(this).toggle(rowText.includes(searchText));
        });
    });

    // Filtro por estado (activo/inactivo)
    $('#statusFilter').change(function() {
        const status = $(this).val();
        $('#proveedoresTable tbody tr').each(function() {
            const isActive = $(this).find('.badge').hasClass('bg-success');
            if (status === "") {
                $(this).show();
            } else if (status === "1" && isActive) {
                $(this).show();
            } else if (status === "0" && !isActive) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });
});
</script>
@endsection