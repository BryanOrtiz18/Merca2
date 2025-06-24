@extends('layouts.app')

@section('title', 'Nuevo Proveedor - MERCA2')

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


<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-user-tie mr-2"></i> Nuevo Proveedor
        </h1>
        <a href="{{ route('proveedores.index') }}" class="btn btn-secondary shadow-sm">
            <i class="fas fa-arrow-left mr-2"></i> Regresar
        </a>
    </div>

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show">
            <i class="fas fa-exclamation-triangle mr-2"></i> Existen errores en el formulario
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3 bg-light">
            <h6 class="m-0 font-weight-bold text-primary">
                <i class="fas fa-info-circle mr-2"></i> Información Básica
            </h6>
        </div>
        <div class="card-body">
            <form action="{{ route('proveedores.store') }}" method="POST" id="proveedorForm">
                @csrf

                <div class="row">
                    <!-- Columna Izquierda -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nombre" class="font-weight-bold">Nombre/Razón Social *</label>
                            <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror" 
                                   value="{{ old('nombre') }}" required autofocus>
                            @error('nombre')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="rtn" class="font-weight-bold">RTN</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                </div>
                                <input type="text" name="rtn" class="form-control @error('rtn') is-invalid @enderror" 
                                       value="{{ old('rtn') }}" placeholder="XXXX-XXXXXX-XXXXX">
                                @error('rtn')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <small class="form-text text-muted">Formato nicaragüense: 4-6-4 dígitos</small>
                        </div>

                        <div class="form-group">
                            <label for="telefono" class="font-weight-bold">Teléfono Principal *</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                </div>
                                <input type="text" name="telefono" class="form-control @error('telefono') is-invalid @enderror" 
                                       value="{{ old('telefono') }}" required placeholder="XXXX-XXXX">
                                @error('telefono')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Columna Derecha -->
                    <div class="col-md-6">
                            <div class="form-group">
                            <label for="nombre_contacto" class="font-weight-bold">Persona de Contacto *</label>
                            <input type="text" name="nombre_contacto" id="nombre_contacto"  class="form-control @error('nombre_contacto') is-invalid @enderror" value="{{ old('nombre_contacto') }}" required>
                    @error('nombre_contacto')
                    <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                    </div>

                        <div class="form-group">
                            <label for="email" class="font-weight-bold">Correo Electrónico</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                </div>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                                       value="{{ old('email') }}">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="activo" class="font-weight-bold">Estado</label>
                            <select name="activo" class="form-control @error('activo') is-invalid @enderror">
                                <option value="1" {{ old('activo', 1) == 1 ? 'selected' : '' }}>Activo</option>
                                <option value="0" {{ old('activo') == 0 ? 'selected' : '' }}>Inactivo</option>
                            </select>
                            @error('activo')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="direccion" class="font-weight-bold">Dirección Completa</label>
                            <textarea name="direccion" class="form-control @error('direccion') is-invalid @enderror" 
                                      rows="2">{{ old('direccion') }}</textarea>
                            @error('direccion')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="observaciones" class="font-weight-bold">Observaciones</label>
                            <textarea name="observaciones" class="form-control @error('observaciones') is-invalid @enderror" 
                                      rows="3">{{ old('observaciones') }}</textarea>
                            @error('observaciones')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-12 text-right">
                        <button type="reset" class="btn btn-secondary mr-2">
                            <i class="fas fa-eraser mr-2"></i> Limpiar
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save mr-2"></i> Guardar Proveedor
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Formato automático para teléfono (Nicaragua)
    $('input[name="telefono"]').on('input', function() {
        var value = this.value.replace(/\D/g, '');
        if (value.length > 4) {
            value = value.substring(0, 4) + '-' + value.substring(4, 8);
        }
        this.value = value;
    });

    // Formato automático para RTN (Nicaragua)
    $('input[name="rtn"]').on('input', function() {
        var value = this.value.replace(/\D/g, '');
        if (value.length > 4) {
            value = value.substring(0, 4) + '-' + value.substring(4, 10) + '-' + value.substring(10, 14);
        } else if (value.length > 10) {
            value = value.substring(0, 4) + '-' + value.substring(4, 10) + '-' + value.substring(10, 14);
        }
        this.value = value.substring(0, 15); // Limitar a 14 caracteres + guiones
    });

    // Validación del formulario
    $('#proveedorForm').validate({
        rules: {
            nombre: "required",
            nombre_contacto: "required",
            telefono: {
                required: true,
                minlength: 9 // XXXX-XXXX = 8 + guión
            },
            email: {
                email: true
            },
            rtn: {
                minlength: 14 // XXXX-XXXXXX-XXXX = 14 caracteres con guiones
            }
        },
        messages: {
            nombre: "Por favor ingrese el nombre del proveedor",
            nombre_contacto: "Por favor ingrese el contacto principal",
            telefono: {
                required: "El teléfono es requerido",
                minlength: "Formato nicaragüense: XXXX-XXXX"
            },
            email: "Ingrese un correo electrónico válido",
            rtn: "El RTN debe tener al menos 14 caracteres (XXXX-XXXXXX-XXXX)"
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }
    });
});
</script>
@endsection