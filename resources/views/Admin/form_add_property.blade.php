@extends('index')

@section('content')
    <div class="container w-25 border p-4 mt-4">
        <form action="{{route('property_added')}}" method="POST">
            @csrf
            @if (session('Exito'))
                <div class="alert alert-success" role="alert">{{session('Exito')}}</div>
            @endif

            @if($errors->any())
                {!! implode('', $errors->all("<div class='alert alert-danger' role='alert'>:message</div>")) !!}
            @endif

            <h5>Insertar Propiedad</h5>
            <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input class="form-control" type="text" placeholder="Default input" aria-label="default input example" name='email'>
            </div>
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" name='nombre'>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control" name='password'>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Teléfono</label>
                <input type="text" class="form-control" name='phone'>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Imagen</label>
                <input type="text" class="form-control" name='image'>
            </div>
            <div class="mb-3">
                <label for="type" class="form-label">Tipo</label>
                <select class="form-select" aria-label="Default select example" name='type'>
                    <option selected>Tipo de usuario</option>
                    <option value="0">No registrado</option>
                    <option value="1">Usuario</option>
                    <option value="2">Vendedor</option>
                    <option value="3">Admin</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection