@extends('app')

@section('content')
<div class="container d-flex flex-column align-items-center justify-content-center">

    @if (session('success'))
        <div class="alert alert-success" role="alert">{{session('success')}}</div>
    @endif

    @if (session('warning'))
        <div class="alert alert-warning" role="alert">{{session('warning')}}</div>
    @endif

    {{-- <section class="col-12 mt-3">
        <form action="{{route('properties.create')}}" method="get">
            <button type="submit" class="btn btn-success rounded-4 borderfade border-0">Añadir Propiedad <i class="fa-solid fa-plus"></i></button>
        </form>
    </section> --}}

    <section class="d-flex container mx-auto col-12 flex-wrap row">

        @forelse($users as $user) 
            <article class="col-12 col-md-6 rounded-4 user_card my-3 mx-auto mx-md-0 px-0 d-flex justify-content-center">

                <div class="card col-11 border-0 p-2 rounded-4" style="width: 16rem; background-color: #e4e3e3">

                    @if (empty($user->image))             
                        <img src="{{asset('Images/assets/noimage.png')}}" alt="1flat" class='card-img-top w-100 rounded user_image object-fit-contain rounded-4 col-12' style="background-color: #4d4d4d">
                    @else
                        <img src={{asset($user->image)}} alt="userphoto" class='card-img-top w-100 rounded user_image object-fit-cover rounded-4 col-12'>
                    @endif
                    
                    <div class="card-body d-flex flex-column px-0">
                        <h5 class="card-title text-start"><b>{{$user->name}}</b></h5>
                        <p class="card-text text-start user-desc">{{$user->email}}</p>
                        <p class="card-text text-start user-phone">{{$user->phone}}</p>
                    </div>
                    {{-- <div class="border-0 p-0 d-flex justify-content-end">
                        <span href="#" class="col-4 text-centerbadge rounded-pill text-bg-primary px-6 py-2">{{$user->phone}} €</span>
                    </div> --}}

                    <div class="dropdown position-absolute start-100">
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

            </article>
        @empty
            <div class="alert alert-warning" role="alert">¡No hay usuarios, esperemos a que se registren!</div>
        @endforelse
    </section>

</div>
    
@endsection