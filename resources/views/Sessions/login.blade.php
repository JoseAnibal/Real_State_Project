@extends('app')

@section('content')
	
    <section class="background-radial-gradient overflow-hidden d-flex flex-column align-items-center justify-content-center w-100">
		<div class="d-flex flex-column mt-3 col-8">
			@if ($errors->any())
				{!! implode('', $errors->all("<div class='alert alert-danger' role='alert'>:message</div>")) !!}
			@endif
			@if (session('success'))
				<div class="alert alert-success" role="alert">{{session('success')}}</div>
			@endif
		</div>
		<div class="d-flex flex-column border rounded-4 col-10 col-md-4 logindiv">
			<form method="POST" action="{{ route('login') }}" class="p-4">
				@csrf
				<div class="mb-4">
					<h4>Inicio de Sesión</h4>
				</div>
				<div class="form-outline mb-4">
					<label class="form-label" for="form3Example3">Correo electrónico</label>
					<input type="email" id="form3Example3" class="form-control" name="email" />
				</div>
	
				<div class="form-outline mb-4">
					<label class="form-label" for="form3Example4">Contraseña</label>
					<input type="password" id="form3Example4" class="form-control" name="password" />
				</div>
	
				<div class="form-check d-flex justify-content-center mb-4">
					<input class="form-check-input me-2" type="checkbox" value="" id="form2Example33" checked />
					<label class="form-check-label" for="form2Example33">
						Mantener sesión iniciada
					</label>
				</div>

				<div class="mb-4">
						<a href="{{route('register')}}">Registrarse</a>
				</div>

				<div>
					<button type="submit" class="btn btn-primary btn-block mb-4 col-12 rounded-5 buttonfadelight">
						Iniciar Sesión
					</button>
				</div>
			</form>
		</div>
    
	</section>
    @endsection