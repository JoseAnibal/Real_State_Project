@extends('app')

@section('content')
    <div class="container w-25 border p-4 mt-4">
        <form action="{{route('properties.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            @if (session('success'))
                <div class="alert alert-success" role="alert">{{session('success')}}</div>
            @endif

            @if($errors->any())
                {!! implode('', $errors->all("<div class='alert alert-danger' role='alert'>:message</div>")) !!}
            @endif

            <h5>Insertar Propiedad</h5>
            <div class="mb-3">
                <label for="email" class="form-label">Título</label>
                <input class="form-control" type="text" placeholder="Default input" aria-label="default input example" name='title'>
            </div>
            <div class="mb-3">
                <label for="nombre" class="form-label">Descripción</label>
                <input type="text" class="form-control" name='description'>
            </div>
            <div class="mb-3">
                <label for="images" class="form-label">Imágenes</label>
                <input type="file" class="form-control" name="image[]" multiple>
            </div>
            <div class="mb-3">
                <label for="adress" class="form-label">Dirección</label>
                <input type="text" class="form-control" name='adress'>
            </div>
            <div class="mb-3">
                <label for="m2" class="form-label">m2</label>
                <input type="number" class="form-control" name='m2'>
            </div>
            <div class="mb-3">
                <label for="type" class="form-label">Tipo</label>
                <select class="form-select" aria-label="Default select example" name='type'>
                    <option selected>Tipo de Propiedad</option>
                    <option value="0">Piso</option>
                    <option value="1">Parking</option>
                    <option value="2">Casa</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="rooms" class="form-label">Habitaciones</label>
                <input type="number" class="form-control" name='rooms'>
            </div>
            <div class="mb-3">
                <label for="baths" class="form-label">Baños</label>
                <input type="number" class="form-control" name='baths'>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Precio</label>
                <input type="number" class="form-control" name='price'>
            </div>
            <div class="mb-3">
                <label for="coordinates" class="form-label">Coordenadas</label>
                <input type="text" class="form-control" name='coordinates'>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Estado</label>
                <select class="form-select" aria-label="Default select example" name='status'>
                    <option selected>Estado</option>
                    <option value="0">Alquilable</option>
                    <option value="1">En venta</option>
                    <option value="3">Vendido</option>
                    <option value="4">Alquilado</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection