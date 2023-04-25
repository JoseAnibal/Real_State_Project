@extends('app')

@section('content')

    <div class="col-8 col-md-6 col-xl-4 container border rounded p-4 my-4 mx-0">
        
        <form action="{{ route('properties.update',['property' => $property->id]) }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            @if (session('success'))
                <div class="alert alert-success" role="alert">{{session('success')}}</div>
            @endif

            @if($errors->any())
                {!! implode('', $errors->all("<div class='alert alert-danger' role='alert'>:message</div>")) !!}
            @endif

            <h5>Editar Propiedad</h5>

            @forelse ($property->images as $image)
            <img src="{{asset($image->image_url)}}" alt="" height="80" width="80">
            @empty
                
            @endforelse

            <div class="mb-3">
                <label for="email" class="form-label">Título</label>
                <input class="form-control" value="{{$property->title}}" type="text" placeholder="Default input" aria-label="default input example" name='title'>
            </div>
            <div class="mb-3">
                <label for="nombre" class="form-label">Descripción</label>
                <input type="text" class="form-control" value="{{$property->description}}" name='description'>
            </div>
            <div class="mb-3">
                <label for="images" class="form-label">Imágenes</label>
                <input type="file" class="form-control" name="image[]" multiple>
            </div>
            <div class="mb-3">
                <label for="adress" class="form-label">Dirección</label>
                <input type="text" class="form-control" value="{{$property->adress}}" name='adress'>
            </div>
            <div class="mb-3">
                <label for="m2" class="form-label">m2</label>
                <input type="number" class="form-control" value="{{$property->m2}}" name='m2'>
            </div>

            @if ($property->type == 0 || $property->type==1)
                <div class="mb-3 roomsfield">
                    <label for="rooms" class="form-label">Habitaciones</label>
                    <input type="number" class="form-control" value="{{$property->rooms}}" name='rooms'>
                </div>
                <div class="mb-3 bathsfield">
                    <label for="baths" class="form-label">Baños</label>
                    <input type="number" class="form-control" value="{{$property->baths}}" name='baths'>
                </div>                
            @endif

            <div class="mb-3">
                <label for="price" class="form-label">Precio</label>
                <input type="number" class="form-control" value="{{$property->price}}" name='price'>
            </div>
            <div class="mb-3">
                <label for="coordinates" class="form-label">Coordenadas</label>
                <input type="text" class="form-control" value="{{$property->coordinates}}" name='coordinates'>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Estado</label>
                <select class="form-select selectortype" aria-label="Default select example" name='status'>
                    <option value="0">Alquilable</option>
                    <option value="1">En venta</option>
                    <option value="2">Vendido</option>
                    <option value="3">Alquilado</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection