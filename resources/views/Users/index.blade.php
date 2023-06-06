@extends('app')

@section('content')
<div class="container d-flex flex-column align-items-center justify-content-center my-3">

    @if (session('success'))
        <div class="alert alert-success" role="alert">{{session('success')}}</div>
    @endif

    @if (session('warning'))
        <div class="alert alert-warning" role="alert">{{session('warning')}}</div>
    @endif
    <section class="w-100 d-flex flex-wrap flex-md-nowrap gap-3 justify-content-center align-items-start">

        <section class="col-10 col-md-4 col-lg-2 filtersdiv bg-graylight rounded-4">
            <h6 class="pt-3"><b>Filtros</b></h6>
            <form class="d-flex flex-column gap-3 p-3" id="filters" action="#" method="post">
                @csrf
                <div class="d-flex flex-column">
                    <label for="email" class="text-start">Tipo de usuario</label>
                    <select class="form-select" name="type" id="type">
                        <option value="all">Todos</option>
                        <option value="0">No registrados</option>
                        <option value="1">Usuarios</option>
                    </select>
                </div>

                <div class="d-flex flex-column">
                    <label for="email" class="text-start">Email</label>
                    <input type="text" name="email" id="email" placeholder="Email" class="form-control">
                </div>

                <div class="d-flex flex-column">
                    <label for="phone" class="text-start">Teléfono</label>
                    <input type="text" name="phone" id="phone" placeholder="Teléfono" class="form-control">
                </div>
            </form>
            <button type="submit" class="btn btn-success rounded-4 borderfade border-0 filter mb-2">Aplicar filtros</button>
        </section>
                
        <section class="col-10 col-md-8">
            <section class="d-flex flex-wrap col-12 mx-0 px-0 justify-content-center gap-3 position-relative" id="userscontainer">

            </section>

            <button type="submit" class="btn rounded-4 border-0 bg-graylight viewmore my-3">Ver mas</button>

        </section>

    </section>
</div>
    
@endsection


{{-- @forelse($users as $user)
                    <div class="col-12 col-xl-5 user-container d-flex rounded-4 position-relative align-items-center bg-graylight">
                        <div class="d-flex h-100">
                            @if (empty($user->image))             
                            <img src="{{asset('Images/assets/noimage.png')}}" alt="1flat" class='rounded user_image object-fit-contain rounded-4' style="width:6rem;background-color: #4d4d4d">
                            @else
                                <img src={{asset($user->image)}} alt="userphoto" class='rounded user_image object-fit-cover rounded-4' style="width:6rem;">
                            @endif
                        </div>
                        <div class="p-3 d-flex flex-column justify-content-between text-start">
                            <h5 class="m-0 text-wrap text-break"><b>Nombre:</b> {{$user->name}}</h5>
                            <p class="m-0 py-2 text-wrap text-break"><b>Email:</b> {{$user->email}}</p>
                            <p class="m-0 text-wrap text-break"><b>Teléfono:</b> {{$user->phone}}</p>
                        </div>
                        <div class="dropdown position-absolute start-100 top-0">
                            <button class="btn rounded-circle border-0 whitetransparent d-flex justify-content-center align-items-center" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-ellipsis"></i>
                            </button>
                            <ul class="dropdown-menu col-6">
                                <li>
                                    <form action="{{route('users.edit', ['user'=>$user->id])}}" method="get" class="dropdown-item px-0 col-8">
                                        <button type="submit" class="btn col-12 px-0 border-0"><i class="fa-solid fa-pen-to-square"></i>Editar</button>
                                    </form>
                                </li>
                                <li>
                                    <form action="{{route('users.destroy', ['user'=>$user->id])}}" method="post" class="dropdown-item px-0 col-8">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn col-12 px-0 border-0"><i class="fa-solid fa-trash"></i>Eliminar</button>
                                    </form>
                                </li>
                            </ul>
                        </div> 
                    </div>
                @empty
                    <div class="alert alert-warning m-auto" role="alert" style="height: fit-content;">¡No hay usuarios, esperemos a que se registren!</div>
                @endforelse --}}