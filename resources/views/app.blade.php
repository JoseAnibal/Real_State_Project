<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"> --}}
    <title>Inmobiliaria REG</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.16/js/bootstrap-multiselect.min.js"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>

    @isset($js)
        <script script type="text/javascript" async src={{$js}} defer></script>
    @endisset

    <link href={{asset("css/app.css")}} rel="stylesheet" type="text/css" >
</head>
<body>

	@php
		echo "Es admin: ";
		var_dump(session()->get('admin'));
		echo " | ";
		echo "Es user: ";
		var_dump(session()->get('email'));
		echo " | ";
		echo "<br>";
		var_dump(session()->get('user'));
		echo " | ";
		echo "<br>";
		var_dump(session()->get('type'));
		echo " | ";
		echo "<br>";
		echo csrf_token();
		echo "<br>";
	@endphp

	<?php
			
	use Illuminate\Support\Facades\Artisan;
		
		# Run the Artisan command
		// Artisan::call("cache:clear");
		# If you need the output
		// $output = Artisan::output();

		// print_r($output);
		print_r($_COOKIE);

	?>

  	@if (!Auth::check())
		
		<nav class="navbar navbar-expand-lg bg-body-tertiary">
			<div class="container-fluid gap-3">
			<div>
				<a href="{{route('landing.home')}}" class="logoD d-flex"><img src="{{asset('Images/assets/logo.png')}}" alt="" class="object-fit-cover w-100 rounded-4"></a>
			</div>
			
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse justify-content-between" id="navbarNavDropdown">
				<div>
				<ul class="navbar-nav">
					<li class="nav-item">
						<a class="nav-link" aria-current="page" href="{{route('home')}}">Inicio</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="{{route('public.rentalproperties')}}">Buscador de propiedades</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="{{route('public.whoarewe')}}">Quiénes somos</a>
					</li>
				</ul>
				</div>
				<div class="loginbtn">
				<form action="{{route('loginin')}}" method="get">
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
					<div>
						<a href="{{route('landing.home')}}" class="logoD d-flex"><img src="{{asset('Images/assets/logo.png')}}" alt="" class="object-fit-cover w-100 rounded-4"></a>
					</div>
					
					<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
					</button>
					<div class="collapse navbar-collapse justify-content-between" id="navbarNavDropdown">
						<div>
							<ul class="navbar-nav">
								<li class="nav-item">
									<a class="nav-link" aria-current="page" href="{{route('home')}}">Inicio</a>
								</li>
								@if (session()->get('type',0) == 1)

									<li class="nav-item">
										<a class="nav-link" href="{{route('registered.index',['property'=>session()->get('property',false)])}}">Mi propiedad</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" href="{{route('registered.showincidences',['property'=>session()->get('property',false)])}}">Incidencias</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" href="{{route('registered.seebills',['user'=>session()->get('user',false)])}}">Facturas</a>
									</li>
								@else
									<li class="nav-item">
										<a class="nav-link" href="{{route('public.rentalproperties')}}">Buscador de propiedades</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" href="#">Quiénes somos</a>
									</li>
								@endif
							</ul>
						</div>
						<div class="dropdown col-2">
							<button class="btn dropdown-toggle d-flex flex-nowrap align-items-center justify-content-between border-0" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="max-width: 10rem !important; width: 10rem">
								<div class="d-flex imageusernav rounded-circle">
									<img src="{{asset(session()->get('image',0))}}" alt="adminimage" class="object-fit-cover rounded-circle">
								</div>
								<div class="text-truncate">
									{{session()->get('name',0)}}
								</div>
							</button>
							<ul class="dropdown-menu">
							<li>
								<form action="{{route('logout')}}" method="post" class="d-flex justify-content-center">
									@csrf
									<button type="submit" class="rounded-4 border-0 p-2"><i class="fa-solid fa-right-from-bracket me-1" style="color: #0070f0;"></i>Cerrar sesión</button>
								</form>
							</li>
							<li>

							</li>
							</ul>
						</div>
					</div>
				</div>
			</nav>
		@else
		
		<nav class="navbar navbar-expand-lg bg-body-tertiary">
		<div class="container-fluid gap-3">
			<div>
				<a href="{{route('landing.home')}}" class="logoD d-flex"><img src="{{asset('Images/assets/logo.png')}}" alt="" class="object-fit-cover w-100 rounded-4"></a>
			</div>
			
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse justify-content-between" id="navbarNavDropdown">
				<div>
					<ul class="navbar-nav">
						<li class="nav-item">
							<a class="nav-link" aria-current="page" href="{{route('home')}}">Inicio</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="{{route('properties.index')}}">Propiedades</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="{{route('users.index')}}">Usuarios</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="{{route('incidences.index')}}">Incidencias</a>
						</li>
					</ul>
				</div>
				<div class="dropdown col-2">
					<button class="btn dropdown-toggle d-flex flex-nowrap align-items-center justify-content-between border-0" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="max-width: 10rem !important; width: 10rem">
						<div class="d-flex imageusernav rounded-circle">
							<img src="{{asset('Images/assets/admin.png')}}" alt="adminimage" class="object-fit-cover rounded-circle">
						</div>
						<div class="text-truncate">
							Admin
						</div>
					</button>
					<ul class="dropdown-menu">
					<li>
						<form action="{{route('logout')}}" method="post" class="d-flex justify-content-center">
							@csrf
							<button type="submit" class="rounded-4 border-0 p-2"><i class="fa-solid fa-right-from-bracket me-1" style="color: #0070f0;"></i>Cerrar sesión</button>
						</form>
					</li>
					</ul>
				</div>
			
			</div>
		</div>
		</nav>

		@endif

	@endif

    <main class="d-flex justify-content-center">
        @yield('content')
    </main>

    <div class="cargando hide">
      <div class="contenedorcar loading">
          <div class="lds-ripple"><div></div><div></div></div>
          <div><h4>Cargando...</h4></div>
      </div>

      <div class="contenedorcar check hide">
        <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52"> 
          <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none"/> <path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
        </svg>
        <div><h4>Correcto!...</h4></div>
      </div>
    </div>

    <div class="message hide">

    </div>

	<footer class="bg-body-tertiary d-flex justify-content-around">
		<div class="d-flex col-4 justify-content-center align-items-center">
			<img src="{{asset('Images/assets/logo.png')}}" alt="" class="object-fit-cover w-100 rounded-circle" style="height: 5rem !important; width: 5rem !important">
		</div>
		<div class="d-flex justify-content-around align-items-center col-8">
			<ul>
				<li><a href="#">Politica de privacidad</a></li>
				<li><a href="#">Cookies</a></li>
			</ul>
			<ul>
				<li>Correo: reg@gmail.com</li>
				<li>Tlf: 678 45 67 52</li>
				<li>Direccion: Calle la loma 23</li>
			</ul>
		</div>
	</footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
</body>
</html>