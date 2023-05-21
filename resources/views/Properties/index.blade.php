@extends('app')

@section('content')
<div class="container d-flex flex-column align-items-center gap-3">

    @if (session('success'))
        <div class="alert alert-success" role="alert">{{session('success')}}</div>
    @endif

    @if (session('warning'))
        <div class="alert alert-warning" role="alert">{{session('warning')}}</div>
    @endif

    <section class="col-12 mt-3">
        <form action="{{route('properties.create')}}" method="get">
            <button type="submit" class="btn btn-success rounded-4 borderfade border-0">Añadir Propiedad <i class="fa-solid fa-plus"></i></button>
        </form>
    </section>

    <section class="container d-flex flex-wrap justify-content-center p-0">
        <section class="col-10 col-sm-10 col-md-4 col-lg-2 filtersdiv bg-graylight rounded-4 p-0" style="height: fit-content;">
            <h6 class="pt-3"><b>Filtros</b></h6>
            <form class="d-flex flex-column gap-3 p-3" id="filters" action="#" method="post">
                @csrf
                <div class="d-flex flex-column">
                    <label for="email" class="text-start">Tipo de Propiedad</label>
                    <select class="form-select" name="type" id="type">
                        <option value="all">Todos</option>
                        <option value="0">Piso</option>
                        <option value="1">Casa</option>
                        <option value="2">Parking</option>
                        <option value="3">Terreno</option>
                    </select>
                </div>
    
                <div class="d-flex flex-column">
                    <label for="title" class="text-start">Título</label>
                    <input type="text" name="title" id="title" placeholder="Título" class="form-control">
                </div>

                <div class="d-flex flex-column">
                    <label for="address" class="text-start">Dirección</label>
                    <input type="text" name="adress" id="address" placeholder="Dirección" class="form-control">
                </div>
            </form>
            <button type="submit" class="btn btn-success rounded-4 borderfade border-0 filter mb-2">Aplicar filtros</button>
        </section>

        <section class="col-10 col-md-8 col-lg-10">
            <section class=" d-flex container mx-auto flex-wrap row justify-content-center" id="propertiescontainer">
    
            </section>
            <button type="submit" class="btn rounded-4 border-0 bg-graylight viewmore my-3">Ver mas</button>
        </section>
    
    </section>

</div>
    
@endsection


{{-- @forelse($properties as $property) 
                <article class="rounded-4 property_card my-3 mx-auto mx-md-0 px-0 col-6 d-flex justify-content-center">
    
                    <div class="card col-11 border-0 p-2 rounded-4" style="width: 16rem; background-color: #e4e3e3">
                        <a href="{{route('properties.show',['property'=>$property->id])}}">
                        @if (empty($property->images[0]->image_url))                    
                            <img src="{{asset('Images/assets/noimage.png')}}" alt="1flat" class='card-img-top w-100 rounded property_image object-fit-contain rounded-4 col-12' style="background-color: #4d4d4d">
                        @else
                            <img src={{asset($property->images[0]->image_url)}} alt="1flat" class='card-img-top w-100 rounded property_image object-fit-cover rounded-4 col-12'>
                        @endif
                        </a>
                        <div class="card-body d-flex flex-column px-0">
                            <a href="{{route('properties.show',['property'=>$property->id])}}" class="text-black">
                                <h5 class="card-title text-start"><b>{{$property->title}}</b></h5>
                            </a>
                            <p class="card-text text-start property-desc">{{$property->description}}</p>
                        </div>
                        <div class="border-0 p-0 d-flex justify-content-end">
                            <span href="#" class="col-4 text-centerbadge rounded-pill text-bg-primary px-6 py-2">{{$property->price}} €</span>
                        </div>
    
                        <div class="dropdown position-absolute start-100">
                            <button class="btn rounded-circle border-0 whitetransparent d-flex justify-content-center align-items-center" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-ellipsis"></i>
                            </button>
                            <ul class="dropdown-menu col-6">
                                <li>
                                    <form action="{{route('properties.edit', ['property'=>$property->id])}}" method="get" class="dropdown-item px-0 col-8">
                                        <button type="submit" class="btn col-12 px-0 border-0"><i class="fa-solid fa-pen-to-square"></i>Editar</button>
                                    </form>
                                </li>
                                <li>
                                    <form action="{{route('properties.destroy', ['property'=>$property->id])}}" method="post" class="dropdown-item px-0 col-8">
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
                <div class="alert alert-warning" role="alert">No hay propiedades! Añade alguna 😢</div>
            @endforelse --}}