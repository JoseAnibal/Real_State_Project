@extends('app')

@section('content')

    <div class="col-8 col-md-6 col-xl-4 container border rounded p-4 my-4 mx-0 divcreate" style="position: relative ">
        <form enctype="multipart/form-data" id="formApi">
            @csrf
            @if (session('success'))
                <div class="alert alert-success" role="alert">{{session('success')}}</div>
            @endif

            @if($errors->any())
                {!! implode('', $errors->all("<div class='alert alert-danger' role='alert'>:message</div>")) !!}
            @endif

            <h5>Insertar Propiedad</h5>
            <div class="mb-3 forjs">
                <label for="title" class="form-label">Título</label>
                <input class="form-control" type="text" aria-label="default input example" name='title'>
            </div>
            <div class="mb-3 forjs">
                <label for="descripcion" class="form-label">Descripción</label>
                <input type="text" class="form-control" name='description'>
            </div>
            <div class="mb-3">
                <h6>Imágenes</h6>
                <div class="imagesselector my-2">

                </div>
                <label class="btn btn-default btn-sm center-block btn-file col-12 rounded-4 text-light imageuploader border-0">
                    <i class="fa fa-upload" aria-hidden="true"></i>
                    <b>Subir Imágenes</b>
                    <input type="file" class="form-control imagesarray" accept="image/*" name="image[]" multiple style="display: none;">
                  </label>
            </div>
            <div class="mb-3 forjs">
                <label for="adress" class="form-label">Dirección</label>
                <input type="text" class="form-control" name='adress'>
            </div>
            <div class="mb-3 forjs">
                <label for="m2" class="form-label">m2</label>
                <input type="number" class="form-control" name='m2'>
            </div>
            <div class="mb-3 forjs">
                {!! $formu !!}
            </div>
            <div class="mb-3 roomsfield forjs">
                <label for="rooms" class="form-label">Habitaciones</label>
                <input type="number" class="form-control" name='rooms'>
            </div>
            <div class="mb-3 bathsfield forjs">
                <label for="baths" class="form-label">Baños</label>
                <input type="number" class="form-control" name='baths'>
            </div>
            <div class="mb-3 forjs">
                <label for="price" class="form-label">Precio</label>
                <input type="number" class="form-control" name='price'>
            </div>
            <div class="mb-3 forjs">
                <label for="coordinates" class="form-label">Coordenadas</label>
                <input type="text" class="form-control" name='coordinates'>
            </div>
            <div class="mb-3 forjs estadofield">
                <label for="status" class="form-label">Estado</label>
                <select class="form-select" aria-label="Default select example" name='status'>
                    <option value="0">Alquilable</option>
                    <option value="1">En venta</option>
                </select>
            </div>
        </form>
        <button class="btn btn-primary sendButton borderfade col-12 border-0 rounded-5">Crear</button>
    </div>
@endsection