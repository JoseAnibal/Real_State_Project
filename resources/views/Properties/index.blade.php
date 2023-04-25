@extends('app')

@section('content')
<div class="container d-flex flex-column align-items-center justify-content-center">

    @if (session('success'))
        <div class="alert alert-success" role="alert">{{session('success')}}</div>
    @endif

    @if (session('warning'))
        <div class="alert alert-warning" role="alert">{{session('warning')}}</div>
    @endif

    <section class="col-12 mt-3">
        <form action="{{route('properties.create')}}" method="get">
            <button type="submit" class="btn btn-success">Añadir Porpiedad <i class="fa-solid fa-plus"></i></button>
        </form>
    </section>

    <section class="d-flex container mx-auto col-12 flex-wrap row">

        @forelse($properties as $property) 
            <article class="rounded-4 property_card my-3 px-0 col-6 d-flex justify-content-center">

                <div class="card border-0 p-2 rounded-4" style="width: 18rem; background-color: #e4e3e3">
                    <img src={{asset($property->images[0]->image_url)}} alt="1flat" class='card-img-top w-100 rounded property_image object-fit-cover rounded-4'>
                    <div class="card-body d-flex flex-column px-0">
                        <h5 class="card-title text-start"><b>{{$property->title}}</b></h5>
                        <p class="card-text text-start property-desc">{{$property->description}}</p>
                    </div>
                    <div class="border-0 p-0 d-flex justify-content-end">
                        <span href="#" class="col-4 text-centerbadge rounded-pill text-bg-primary px-6 py-2">{{$property->price}} €</span>
                    </div>
                    <form action="{{route('properties.edit', ['property'=>$property->id])}}" method="get" class="corner-right">
                        <button type="submit" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></button>
                    </form>
                </div>

            </article>
        @empty
            <div class="alert alert-warning" role="alert">No hay propiedades! Añade alguna 😢</div>
        @endforelse
    </section>

</div>
    
@endsection