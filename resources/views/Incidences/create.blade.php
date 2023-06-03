@extends('app')

@section('content')

    <div class="col-8 col-md-6 col-xl-4 container border rounded p-4 my-4 mx-0 divcreate" style="position: relative ">
        <form enctype="multipart/form-data" method="POST" action="{{route('registered.storeincidence')}}">
            @csrf
            @if (session('success'))
                <div class="alert alert-success" role="alert">{{session('success')}}</div>
            @endif

            @if($errors->any())
                {!! implode('', $errors->all("<div class='alert alert-danger' role='alert'>:message</div>")) !!}
            @endif

            <h5>Crear nueva incidencia</h5>
            <div class="mb-3">
                <h6>Imagen</h6></h6>
                <div class="imagesselector my-2">
                    <div class="d-flex flex-wrap justify-content-around align-items-center">
                        <div class="d-flex object-fit-cover" style="height: 6rem; width: 6rem; position: relative;">
                            <img class="object-fit-cover w-100 rounded-4" src="{{asset('Images/assets/noimage.png')}}">
                        </div>
                    </div>
                </div>
                <label class="btn btn-default btn-sm center-block btn-file col-12 rounded-4 text-light imageuploader border-0">
                    <i class="fa fa-upload" aria-hidden="true"></i>
                    <b>Subir Imagen</b>
                    <input type="file" class="form-control imagesarray" accept="image/*" name="image" style="display: none;">
                </label>
            </div>
            <div class="mb-3 forjs">
                <label for="title" class="form-label">Título</label>
                <input type="text" class="form-control" name='title'>
            </div>
            <div class="form-floating mb-3">
                <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px" name="description"></textarea>
                <label for="floatingTextarea2">Descripción</label>
            </div>
            <button class="btn btn-primary sendButton borderfade rounded-5 border-0 w-100">Crear Incidencia</button>
        </form>
        
    </div>
@endsection