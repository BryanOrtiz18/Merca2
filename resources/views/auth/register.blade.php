<!doctype html>
<html lang="en">
    <head>
        <title>Merca2 Mini Market</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"crossorigin="anonymous"
        />
        <link rel="stylesheet" href="{{ asset('public/assets/estilos.css') }}">
        
    </head>

    <body>
      
   <section style="min-height: 100vh; display: flex; align-items: stretch;">
  <div class="container-fluid">
    <div class="row align-items-stretch" style="min-height: 100vh;">
      
      <!-- Columna izquierda con el formulario -->
      <div class="col-sm-6 d-flex flex-column justify-content-center text-black">
        <div class="px-5 ms-xl-4 d-flex align-items-center mb-4">

          <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">
          <img src="{{ asset('assets/imgs/logo.jpeg') }}" alt="Logo" style="height: 130px; margin-right: 10px;">
          </a>
          
          <span class="h1 fw-bold mb-0">MINI MARKET</span>
        </div>

        <div class="d-flex align-items-center px-5 ms-xl-4">
          <form action="{{route('register')}}" method="post" style="width: 23rem;">
            @csrf

            <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Registrarse</h3>

            <div class="form-outline mb-4">
              <label class="form-label">Nombre:</label>
              <input type="text" name="name" class="form-control form-control-lg" placeholder="Ingrese su nombre..." />
            </div>

            <div class="form-outline mb-4">
              <label class="form-label">Correo:</label>
              <input type="email" name="email" class="form-control form-control-lg" placeholder="Ingrese su correo..." />
            </div>

            <div class="form-outline mb-4">
              <label class="form-label">Contraseña:</label>
              <input type="password" name="password" class="form-control form-control-lg" placeholder="Ingrese su contraseña..." />
            </div>

            <div class="form-outline mb-4">
              <label class="form-label">Confirmar contraseña:</label>
              <input type="password" name="password_confirmation" class="form-control form-control-lg" placeholder="Confirme su contraseña..." />
            </div>

            <div class="pt-1 mb-4">
              <button class="btn btn-info btn-lg btn-block" type="submit">Registrarse</button>
            </div>

            <p class="small mb-5 pb-lg-2"><a class="text-muted" href="#">¿Has olvidado tu contraseña?</a></p>
            <p>Ir al ingreso de sesion  <a href="{{route('login')}}" class="link-info">   Iniciar Sesión</a></p>



            @if ($errors->any())
                <div class="alert alert-danger">
            <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
                </div>
            @endif






          </form>
        </div>
      </div>

      <!-- Columna derecha con imagen -->
      <div class="col-sm-6 px-0 d-none d-sm-block">
        <img src="{{ asset('assets/imgs/minimarket.jpg') }}" alt="Login image"
          class="w-100 h-100" style="object-fit: cover; object-position: left;">
      </div>
    </div>
  </div>
</section>





        <!-- Bootstrap JavaScript Libraries -->
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>

    </body>
</html>
