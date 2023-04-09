@extends('app')

@section('content')
    <div class="container w-25 border p-4 mt-4">
        <form action="{{route('user_added')}}" method="POST">
            @csrf
            @if (session('Exito'))
                <div class="alert alert-success" role="alert">{{session('Exito')}}</div>
            @endif

            @php
                use App\Models\User;
                use App\Models\Property;

                $user=User::first();
                $property=Property::find(10);


                //Ver las propiedades(en este caso solo la primera) que tiene el usuario en favorito
                // dump($user->favs[0]->properties->toArray());

                //Ver el alquiler que tiene el usuario
                // dd($user->rental->property->toArray());

                //Ver todos los usuarios que hya dentro de una propiedad
                // foreach ($property->rentals as $rental) {
                //     dump($rental->user->toArray());
                // }
                
                //Ver todas las facturas de una propiedad
                // dump($property->rentals[0]->bills->toArray());

                //Ver todas las incidencias de una propiedad
                // dump($property->rentals[0]->incidences->toArray());
                // die();

                //Ver todas las fotos de un piso
                dump($property->images->toArray());
                
                foreach ($property->images as $image) {
                    echo "<img src='$image->image_url' alt='' width=200px height=200px> <br>";
                }
                
                

            @endphp

            @if($errors->any())
                {!! implode('', $errors->all("<div class='alert alert-danger' role='alert'>:message</div>")) !!}
            @endif

            <h5>Insertar usuario</h5>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input class="form-control" type="text" placeholder="Default input" aria-label="default input example" name='email'>
            </div>
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" name='name'>
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