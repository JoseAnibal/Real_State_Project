@extends('app')

@section('content')

    <section class="container my-3 d-flex flex-column gap-3">
        <div>
            <form action="{{route('properties.useradd',['property'=>$property])}}" method="POST">
                @csrf
                <button type="submit" class="btn borderfade text-white border-0 rounded-5">Añadir usuarios</button>
            </form>
        </div>
        <div class="userlist d-flex justify-content-center align-items-center flex-wrap gap-2">

            @forelse ($users as $user)
                <div class="col-12 col-md-5 col-xl-5 user-container d-flex rounded-4 position-relative align-items-center bg-graylight divChild">
                    <div class="d-flex h-100">    
                        <img src="{{asset($user->image)}}" alt="1flat" class='rounded user_image object-fit-contain rounded-4 bg-graylight' style="width:6rem;">
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
                                <form action="{{route('rentals.edit',['rental'=>$user->rental])}}" method="get" class="dropdown-item px-0 col-8">
                                    <button type="submit" class="btn col-12 px-0 border-0"><i class="fa-solid fa-pen"></i> Editar Alquiler</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            @empty
                <div class='d-flex col-10 rounded-4 bg-graylight flex-column h-100 justify-content-center align-items-center h-100 w-100'>
                
                    <div class="p-3">
                        <img src="{{asset('Images/assets/empty.png')}}" alt="1flat" class='rounded user_image object-fit-contain rounded-4' style="width:8rem;background-color: #F3F3F3">
                    </div>
                    <div>
                        <h5>Ningun usuario añadido aún.</h5>
                    </div>
                
                </div>
            @endforelse
        </div>
    </section>

@endsection