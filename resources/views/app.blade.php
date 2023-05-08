<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inmobiliaria REG</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    @isset($js)
        <script script type="text/javascript" async src={{$js}} defer></script>
    @endisset

    <link href={{asset("css/app.css")}} rel="stylesheet" type="text/css" >
</head>
<body>

  @php
    
      var_dump(session()->get('admin'));

  @endphp

  @if (empty(session()->get('admin')))

  SESION VACIA
    
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid gap-3">
      <div class="logoD d-flex">
        <img src="{{asset('Images/assets/logo.png')}}" alt="" class="object-fit-cover w-100 rounded-4">
      </div>
      
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-between" id="navbarNavDropdown">
        <div>
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">Inicio</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Alquiler</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Compra</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Quiénes somos</a>
            </li>
            {{-- <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Dropdown link
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
              </ul>
            </li> --}}
          </ul>
        </div>
        <div class="loginbtn">
          <form action="{{route('loginform')}}" method="get">
            <button type="submit" class="rounded-4 border-0 p-2"><i class="fa-solid fa-user me-1" style="color: #0070f0;"></i> Iniciar sesión</button>
          </form>
        </div>
        
      </div>
    </div>
  </nav>

  @else
    @if (!session()->get('admin',false))
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
      <div class="container-fluid gap-3">
        <div class="logoD d-flex">
          <img src="{{asset('Images/assets/logo.png')}}" alt="" class="object-fit-cover w-100 rounded-4">
        </div>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between" id="navbarNavDropdown">
          <div>
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Inicio</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Alquiler</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Compra</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Quiénes somos</a>
              </li>
              {{-- <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Dropdown link
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="#">Action</a></li>
                  <li><a class="dropdown-item" href="#">Another action</a></li>
                  <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
              </li> --}}
            </ul>
          </div>
          <div class="loginbtn">
            <form action="{{route('logout')}}" method="post">
              @csrf
              <button type="submit" class="rounded-4 border-0 p-2"><i class="fa-solid fa-right-from-bracket me-1" style="color: #0070f0;"></i>Cerrar sesión</button>
            </form>
          </div>
          
        </div>
      </div>
    </nav>
    @else
      
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
      <div class="container-fluid gap-3">
        <div class="logoD d-flex">
          <img src="{{asset('Images/assets/logo.png')}}" alt="" class="object-fit-cover w-100 rounded-4">
        </div>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between" id="navbarNavDropdown">
          <div>
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Inicio</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{route('properties.index')}}">Propiedades</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{route('users.index')}}">Usuarios</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Incidencias</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Facturas</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Chat</a>
              </li>
              {{-- <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Dropdown link
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="#">Action</a></li>
                  <li><a class="dropdown-item" href="#">Another action</a></li>
                  <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
              </li> --}}
            </ul>
          </div>
          <div class="loginbtn">
            <form action="{{route('logout')}}" method="post">
              @csrf
              <button type="submit" class="rounded-4 border-0 p-2"><i class="fa-solid fa-right-from-bracket me-1" style="color: #0070f0;"></i>Cerrar sesión</button>
            </form>
          </div>
          
        </div>
      </div>
    </nav>

    @endif

  @endif

    <main class="d-flex justify-content-center">
      <?php
        
        use Illuminate\Support\Facades\Artisan;
            
            # Run the Artisan command
            Artisan::call("config:cache");
            # If you need the output
            $output = Artisan::output();

            print_r($output);
        
        ?>
        @yield('content')
    </main>

    <div class="cargando hide">
      <div class="contenedorcar">
          <div class="lds-ripple"><div></div><div></div></div>
          <div><h4>Cargando...</h4></div>
      </div>
    </div>

    <div class="message hide">

    </div>

    <footer class="bg-secondary text-center text-lg-start text-white" data-bs-theme="dark">
      <!-- Grid container -->
      <div class="container p-2">
        <!--Grid row-->
        <div class="row mx-1">
          <!--Grid column-->
          <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
  
            <div class="rounded-circle bg-white shadow-1-strong d-flex align-items-center justify-content-center mb-4 mx-auto" style="width: 150px; height: 150px;">
              <img src={{asset("Images/assets/logo.png")}} class="object-fit-cover rounded-circle w-100 h-100" alt=""
                   loading="lazy" />
            </div>
  
            <p class="text-center">REG inmobiliaria</p>
  
            <ul class="list-unstyled d-flex flex-row justify-content-center">
              <li>
                <a class="text-white px-2" href="#!">
                  <i class="fab fa-facebook-square"></i>
                </a>
              </li>
              <li>
                <a class="text-white px-2" href="#!">
                  <i class="fab fa-instagram"></i>
                </a>
              </li>
              <li>
                <a class="text-white ps-2" href="#!">
                  <i class="fab fa-youtube"></i>
                </a>
              </li>
            </ul>
  
          </div>
          <!--Grid column-->
  
          <!--Grid column-->
          <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
            <h5 class="text-uppercase mb-4">Contact</h5>
  
            <ul class="list-unstyled">
              <li>
                <p><i class="fas fa-map-marker-alt pe-2"></i>Warsaw, 57 Street, Poland</p>
              </li>
              <li>
                <p><i class="fas fa-phone pe-2"></i>+ 01 234 567 89</p>
              </li>
              <li>
                <p><i class="fas fa-envelope pe-2 mb-0"></i>contact@example.com</p>
              </li>
            </ul>
          </div>
          <!--Grid column-->
        </div>
        <!--Grid row-->
      </div>
      <!-- Grid container -->
  
      <!-- Copyright -->
      <div class="text-center p-3" style="background-color: #00000033">
        © 2020 Copyright:
        <a class="text-white" href="#">REG.com</a>
      </div>
      <!-- Copyright -->
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
</body>
</html>