@extends('app')

@section('content')

    <div class="col-8 col-md-6 col-xl-4 container border rounded p-4 my-4 mx-0 divcreate" style="position: relative ">
        <form enctype="multipart/form-data" id="formApi" method="POST" action="{{route('users.update',['user'=>$user->id])}}">
            @method('PATCH')
            @csrf
            @if (session('success'))
                <div class="alert alert-success" role="alert">{{session('success')}}</div>
            @endif

            @if($errors->any())
                {!! implode('', $errors->all("<div class='alert alert-danger' role='alert'>:message</div>")) !!}
            @endif

            <h5>Editar Usuario</h5>
            <div class="mb-3">
                <h6>Imagen</h6></h6>
                <div class="imagesselector my-2">
                    <div class="d-flex flex-wrap justify-content-around align-items-center">
                        <div class="d-flex object-fit-cover" style="height: 6rem; width: 6rem; position: relative;">
                        @if (empty($user->image))
                            <img class="object-fit-cover w-100 rounded-4" src="{{asset('Images/assets/noimage.png')}}">
                        @else
                            <img class="object-fit-cover w-100 rounded-4" src="{{asset($user->image)}}">
                        @endif
                        </div>
                    </div>
                </div>
                <label class="btn btn-default btn-sm center-block btn-file col-12 rounded-4 text-light imageuploader border-0">
                    <i class="fa fa-upload" aria-hidden="true"></i>
                    <b>Subir Imagen</b>
                    <input type="file" class="form-control imagesarray" accept="image/*" name="image[]" style="display: none;">
                  </label>
            </div>
            <div class="mb-3 forjs">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" name='email' value="{{$user->email}}">
            </div>
            <div class="mb-3 forjs">
                <label for="m2" class="form-label">Nombre</label>
                <input type="text" class="form-control" name='name' value="{{$user->name}}">
            </div>
            <div class="mb-3 forjs">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control" name='password'>
            </div>
            <div class="mb-3 forjs">
                <label for="phone" class="form-label">Teléfono</label>
                <input type="number" class="form-control" name='phone' value="{{$user->phone}}">
            </div>
            <div class="mb-3 forjs estadofield">
                <label for="type" class="form-label">Tipo</label>
                <select class="form-select" aria-label="Default select example" name='type'>
                    
                    @foreach ($type as $key=>$value)
                        @if ($key == $user->type)
                            <option value="{{$key}}" selected>{{$value}}</option>
                        @else
                            <option value="{{$key}}">{{$value}}</option>
                        @endif
                    @endforeach
                    
                </select>
            </div>
            <button class="btn btn-primary sendButton borderfade rounded-5 border-0 w-100">Editar</button>
        </form>
        
    </div>
@endsection