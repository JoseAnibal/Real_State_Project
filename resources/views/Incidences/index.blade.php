@extends('app')

@section('content')

    <section class="container my-3 d-flex flex-column gap-3">
        <div>
            <form action="{{route('registered.createincidence',['property'=>session()->get('property',false)])}}" method="get">
                @csrf
                <button type="submit" class="btn borderfade text-white border-0 rounded-5">Añadir incidencia</button>
            </form>
        </div>
        <div class="userlist d-flex justify-content-center align-items-center flex-wrap gap-2">

            @forelse ($incidences as $incidence)
                <div class="col-12 user-container d-flex rounded-4 position-relative align-items-center bg-graylight divChild">
                    <div class="d-flex h-100">  
                        <img src="{{asset($incidence->image_url)}}" alt="1flat" class='rounded user_image object-fit-cover rounded-4 bg-graylight col-12 ms-2' style="height: 6rem; width: 12rem;">
                    </div>
                    <div class="p-3 d-flex flex-column justify-content-between text-start">
                        <h5 class="m-0 text-wrap text-break"><b>Titulo:</b> {{$incidence->title}}</h5>
                        <p class="m-0 py-2 text-wrap text-break"><b>Descripción:</b> {{$incidence->description}}</p>
                        <p class="m-0 text-wrap text-break"><b>Fecha de creación:</b> {{$incidence->date}}</p>
                    </div>
                </div>
            @empty
                <div class='d-flex col-12 rounded-4 bg-graylight flex-column h-100 justify-content-center align-items-center h-100 w-100'>
                
                    <div class="p-3">
                        <img src="{{asset('Images/assets/empty.png')}}" alt="1flat" class='rounded user_image object-fit-contain rounded-4' style="width:8rem;background-color: #F3F3F3">
                    </div>
                    <div>
                        <h5>Ninguna incidencia creada aún. (Si hay algún problema añade una nueva.)</h5>
                    </div>
                
                </div>
            @endforelse
        </div>
    </section>

@endsection